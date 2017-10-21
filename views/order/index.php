<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="container">
    <?php if(Yii::$app->user->isGuest): ?>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($order, 'name') ?>
        <?= $form->field($order, 'email') ?>
        <?= $form->field($order, 'phone')->widget(yii\widgets\MaskedInput::className(), ['mask' => '+38(099)999-99-99']) ?>
        <?= \himiklab\yii2\recaptcha\ReCaptcha::widget(['name' => 'reCaptcha']) ?>
        <br />
        <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
    <?php else: ?>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($order, 'name')->textInput(['value' => Yii::$app->user->identity->name]) ?>
        <?= $form->field($order, 'email')->textInput(['value' => Yii::$app->user->identity->email]) ?>
        <?= $form->field($order, 'phone')->widget(yii\widgets\MaskedInput::className(), ['mask' => '+38(099)999-99-99'])->textInput(['value' => Yii::$app->user->identity->phone]) ?>
        <?= \himiklab\yii2\recaptcha\ReCaptcha::widget(['name' => 'reCaptcha']) ?>
        <br />
        <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
    <?php endif; ?>
    <br />
</div>
