<?php

namespace app\models;

use Yii;
use yii\base\Model;
use \himiklab\yii2\recaptcha\ReCaptchaValidator;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $username;
    public $name;
    public $email;
    public $password;
    public $phone;
    public $password_repeat;
    public $reCaptcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['name', 'trim'],
            ['name', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Логин уже занят'],
            ['username', 'string', 'min' => 4, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Email уже занят'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false, 'message' => "Пароли не совпадают"],
            [['reCaptcha'], ReCaptchaValidator::className(), 'secret' => '6LfmySoUAAAAAHnh_B0gEAhTqMqUSItARggQBdxq', 'uncheckedMessage' => 'Подтвердите, что Вы не робот.', 'message' => 'Не прошли проверку'],
            ['phone', 'required'],
            [['phone'], 'udokmeci\yii2PhoneValidator\PhoneValidator', 'country'=>'UA']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {

        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->phone = $this->phone;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->save();
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('user');
        $auth->assign($authorRole, $user->getId());
        return $user;
    }

}