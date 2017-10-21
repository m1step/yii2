<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>

<div class="container">
    <h2>Привет, <?= $user->name; ?></h2>
    <ul class="nav nav-pills">
        <li role="presentation"><a href="<?= Url::to(['profile/index']) ?>">Мои данные</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/my-order-list']) ?>">Мои заказы</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/my-wish-list']) ?>">Мой список желаний</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/change-email']) ?>">Изменить email</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/request-password-reset']) ?>">Изменить пароль</a></li>
        <li role="presentation"><a href="<?= Url::to(['site/logout']) ?>">Выход</a></li>
    </ul>
    <br />
    <p>Пожалуйста, введите Ваш email для смены пароля</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <?= $form->field($model, 'email')->textInput() ?>
            <br />
            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>