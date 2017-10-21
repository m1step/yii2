<?php

namespace app\controllers;



use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\HttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use rmrevin\yii\ulogin\AuthAction;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

class SiteController extends AppController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'ulogin-auth' => [
                'class' => AuthAction::className(),
                'successCallback' => [$this, 'uloginSuccessCallback'],
                'errorCallback' => function($data){
                    Yii::error($data['error']);
                },
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }



    public function beforeAction($action)
    {
        if ($this->action->id == 'ulogin-auth')
        {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('Спасибо, мы с Вами свяжемся в ближайшее время!');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($user = $model->signup())
            {
				$auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('user');
                $auth->assign($authorRole, $user->getId());
                if (Yii::$app->getUser()->login($user))
                {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', compact('model'));
    }




    public function uloginSuccessCallback($attributes)
    {
        if($user = User::findByUsername($attributes['uid']))
        {
            Yii::$app->getUser()->login($user, 3600 * 24 * 30);
            return $this->goHome();
        }else
        {
            if($user = User::findByEmail($attributes['email']))
            {
                Yii::$app->session->setFlash('error', 'Пользователь с таким email уже существует. ' . "<a href=" . Url::to(['site/request-password-reset']) . ">Восстановить пароль</a>?");
                return $this->redirect(['site/login']);
            }
            $signin = new User();
            $signin->name = $attributes['first_name'];
            $signin->email = $attributes['email'];
            $signin->username = $attributes['uid'];
            $signin->status = 10;
            $signin->phone = $attributes['phone'];
            $signin->created_at = time();
            $signin->generateAuthKey();
            $signin->setPassword('string');
            if($signin->save())
            {
                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('user');
                $auth->assign($authorRole, $signin->getId());
                $user = User::findByUsername($signin->username);
                Yii::$app->getUser()->login($user, 3600 * 24 * 30);
                Yii::$app->session->setFlash('success', 'Регистрация и авторизация произведена успешно! Рекомендуем <b><a href='. Url::to(['profile/create-password']) . ">создать пароль</a></b>");
                return $this->goHome();
            }
        }
        return true;
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Зайдите на Ваш email для дальнейшего восстановления пароля');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }

        return $this->render('passwordResetRequestForm', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен');
            return $this->redirect(['site/login']);
        }

        return $this->render('resetPasswordForm', [
            'model' => $model]);
      }

    public function actionAjaxLogin() {
        if (Yii::$app->request->isAjax) {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post())) {
                if ($model->login()) {
                    return $this->goBack();
                } else {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
            }
        } else {
            throw new HttpException(404 ,'Page not found');
        }
    }

}
