<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Заполните ВСЕ поля для регистрации</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'username')->textInput()->label('Логин') ?>
            <?= $form->field($model, 'name')->label('Имя') ?>
            <?= $form->field($model, 'email')->label('Email') ?>
            <?= $form->field($model, 'phone')->widget(yii\widgets\MaskedInput::className(), ['mask' => '+38(099)999-99-99'])->label('Номер телефона') ?>
            <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
            <?= $form->field($model, 'password_repeat')->passwordInput()->label('Подтвердите пароль') ?>
            <?= \himiklab\yii2\recaptcha\ReCaptcha::widget(['name' => 'reCaptcha']) ?>
            <br />
            <div class="form-group">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>