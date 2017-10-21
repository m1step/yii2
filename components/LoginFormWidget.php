<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\LoginForm;

class LoginFormWidget extends Widget {

    public function run() {
        if (Yii::$app->user->isGuest) {
            $model = new LoginForm();
            return $this->render('loginFormWidget', compact('model'));
        } else {
            return false;
        }
    }

}