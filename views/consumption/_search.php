<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\Consumption $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="consumption-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'consumption_id') ?>

    <?= $form->field($model, 'consumption_value') ?>

    <?= $form->field($model, 'consumption_date_register') ?>

    <?= $form->field($model, 'consumption_type') ?>

    <?= $form->field($model, 'consumption_reverse_pules') ?>

    <?php // echo $form->field($model, 'consumption_circuit_temperature') ?>

    <?php // echo $form->field($model, 'consumption_battery_voltage') ?>

    <?php // echo $form->field($model, 'consumption_flags') ?>

    <?php // echo $form->field($model, 'consumption_datetime') ?>

    <?php // echo $form->field($model, 'consumption_full_value') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
