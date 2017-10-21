<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>


<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($order, 'status')->dropDownList([0 => 'Новый', 1 => 'Обработан'], ['options' =>[$orderToUpdate->status => ['Selected' => true]]]) ?>
    <?= $form->field($order, 'name')->textInput(['value' => $orderToUpdate->name]) ?>
    <?= $form->field($order, 'email')->textInput(['value' => $orderToUpdate->email]) ?>
    <?= $form->field($order, 'phone')->textInput(['value' => $orderToUpdate->phone]) ?>
    <?= Html::submitButton('Редактировать', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>


