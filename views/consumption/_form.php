<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Consumption $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="consumption-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'consumption_value')->textInput() ?>

    <?= $form->field($model, 'consumption_date_register')->textInput() ?>

    <?= $form->field($model, 'consumption_type')->textInput() ?>

    <?= $form->field($model, 'consumption_reverse_pules')->textInput() ?>

    <?= $form->field($model, 'consumption_circuit_temperature')->textInput() ?>

    <?= $form->field($model, 'consumption_battery_voltage')->textInput() ?>

    <?= $form->field($model, 'consumption_flags')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'consumption_datetime')->textInput() ?>

    <?= $form->field($model, 'consumption_full_value')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
