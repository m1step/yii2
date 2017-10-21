<?php
use yii\helpers\Url;
use\yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="container">
    <h2>Привет, <?= $updateUser->name; ?></h2>
    <ul class="nav nav-pills">
        <li role="presentation"><a href="<?= Url::to(['profile/index']) ?>">Мои данные</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/my-order-list']) ?>">Мои заказы</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/my-wish-list']) ?>">Мой список желаний</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/change-email']) ?>">Изменить email</a></li>
        <li role="presentation"><a href="<?= Url::to(['profile/request-password-reset']) ?>">Изменить пароль</a></li>
        <li role="presentation"><a href="<?= Url::to(['site/logout']) ?>">Выход</a></li>
    </ul>
    <br />
    <div class="col-lg-5">
    <p>Введите новый желаемый email</p>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($updateUser, 'email')->textInput() ?>
        <?= $form->field($updateUser, 'password_hash')->passwordInput(['value' => ''])->label('Пароль') ?>
        <?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
    <br />
    </div>
</div>