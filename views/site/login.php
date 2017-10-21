<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\ulogin\ULogin;

$this->title = 'Автоизация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Заполните для авторизации:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'rememberMe')->checkbox([
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ]) ?>
    <div style="color:#999;margin:1em 0">
        Если Вы забыли пароль - вы можете <?= Html::a('восстановить', ['site/request-password-reset']) ?> его.
    </div>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <p>Или войдите через социальную сеть:</p>
    <?= ULogin::widget([
        // widget look'n'feel
        'display' => ULogin::D_PANEL,

        // required fields
        'fields' => [ULogin::F_FIRST_NAME, ULogin::F_EMAIL, ULogin::F_PHONE, ULogin::F_PHOTO_BIG],

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
    <br />
</div>