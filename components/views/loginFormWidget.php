<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use rmrevin\yii\ulogin\ULogin;

Modal::begin([
    'header'=>'<h4>Авторизация</h4>',
    'id'=>'login-modal',
]);
?>

    <p>Заполните для авторизации:</p>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => true,
    'action' => ['site/ajax-login']
]);
echo $form->field($model, 'email')->textInput();
echo $form->field($model, 'password')->passwordInput();
echo $form->field($model, 'rememberMe')->checkbox();
?>
    <br />
    <div>
        Если Вы забыли пароль - вы можете <?= Html::a('восстановить', ['site/request-password-reset']) ?> его.
    </div>
    <div class="form-group">
        <div class="text-right">
            <?= Html::submitButton('Авторизация', ['class' => 'btn btn-primary', 'name' => 'login-button']); ?>
        </div>
    </div>

<?php
ActiveForm::end();
?>
    <p>Или войдите через социальную сеть</p>
    <?= ULogin::widget([
        // widget look'n'feel
        'display' => ULogin::D_PANEL,

        // required fields
        'fields' => [ULogin::F_FIRST_NAME, ULogin::F_LAST_NAME, ULogin::F_EMAIL, ULogin::F_PHONE, ULogin::F_CITY, ULogin::F_COUNTRY, ULogin::F_PHOTO_BIG],

        // optional fields
        'optional' => [ULogin::F_BDATE],

        // login providers
        'providers' => [ULogin::P_VKONTAKTE, ULogin::P_FACEBOOK, ULogin::P_TWITTER, ULogin::P_GOOGLE, ULogin::P_ODNOKLASSNIKI],

        // login providers that are shown when user clicks on additonal providers button
        'hidden' => [],

        // where to should ULogin redirect users after successful login
        'redirectUri' => ['site/ulogin-auth'],

        // optional params (can be ommited)
        // force widget language (autodetect by default)
        'language' => ULogin::L_RU,

        // providers sorting ('relevant' by default)
        'sortProviders' => ULogin::S_RELEVANT,

        // verify users' email (disabled by default)
        'verifyEmail' => '0',

        // mobile buttons style (enabled by default)
        'mobileButtons' => '1',
    ]); ?>
<?php
Modal::end();