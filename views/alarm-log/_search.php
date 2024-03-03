<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\AlarmLog $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alarm-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'alarmlog_id') ?>

    <?= $form->field($model, 'alarmlog_origin') ?>

    <?= $form->field($model, 'alarmlog_email') ?>

    <?= $form->field($model, 'alarmlog_table_name') ?>

    <?= $form->field($model, 'alarmlog_table_id') ?>
    
    <?= $form->field($model, 'alarmlog_date') ?>
    <?= $form->field($model,  'alarmlog_simplified') ?>
   
    <?php // echo $form->field($model, 'alarmlog_status') ?>

    <?php // echo $form->field($model, 'alarmlog_description') ?>

    <?php // echo $form->field($model, 'alarmlog_type') ?>

    <?php // echo $form->field($model, 'alarmlog_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
