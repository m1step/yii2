<?php

namespace app\controllers;

use app\models\Order;
use app\models\PasswordResetRequestForm;
use app\models\User;
use app\models\Wishlist;
use \app\models\Product;
use rico\yii2images\models\Image;
use Yii;
use yii\filters\AccessControl;

class ProfileController extends AppController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }


    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        return $this->render('index', compact('user'));
    }

    public function actionChangeEmail()
    {
        $updateUser = User::findByUsername(Yii::$app->user->identity->username);
        if(Yii::$app->request->post()) {
            $post = Yii::$app->request->post('User');
            if($post['email'] == $updateUser->email)
            {
                Yii::$app->session->setFlash('error', 'Email должен отличаться от текущего');
                return $this->refresh();
            }
            if(Yii::$app->security->validatePassword($post['password_hash'], $updateUser->password_hash)) {
                $updateUser->email = $post['email'];
                if ($updateUser->validate()) {
                    $updateUser->update();
                    Yii::$app->session->setFlash('success', 'Email успешно изменен');
                    $this->redirect('profile/index');
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка');
                }
            }else {
                Yii::$app->session->setFlash('error', 'Проверьте пароль');
                return $this->refresh();
            }
        }
        return $this->render('changeEmail', compact( 'updateUser'));
    }

    public function actionRequestPasswordReset()
    {
        $user = Yii::$app->user->identity;
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Зайдите на Ваш email для дальнейшего восстановления пароля');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }

        return $this->render('passwordResetRequestForm', compact('user', 'model'));
    }

    public function actionCreatePassword()
    {
        $user = Yii::$app->user->identity;
        $model = new PasswordResetRequestForm();
        $model->email = $user->email;
        if ($model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Зайдите на Ваш email для дальнейших инструкций');
                return $this->goHome();
            }
        }

        return $this->goHome();
    }


    public function actionMyOrderList()
    {
        $user = Yii::$app->user->identity;
        $orderList = Order::find()->where(['user_id' => $user->id])->all();
        return $this->render('myOrderList', compact('orderList','orderItems', 'user'));
    }


    public function actionMyWishList()
    {
        $user = User::findByUsername(Yii::$app->user->identity->username);
        $wishes = $user->getProducts()->all();
        return $this->render('wish-list', compact('user', 'wishes'));
    }



    public function actionShowModalItems()
    {
        $id = Yii::$app->request->get('id');
        $order = Order::findOne($id);
        $items = $order->getProducts()->all();

        $this->layout = false;
        return $this->render('modal-items', compact('items', 'order'));
    }
}