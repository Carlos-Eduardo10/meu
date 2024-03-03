<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\Alarm $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alarm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'alarm_id') ?>

    <?= $form->field($model, 'alarm_name') ?>

    <?= $form->field($model, 'alarm_description') ?>

    <?= $form->field($model, 'alarm_type') ?>

  <?= $form->field($model, 'alarm_type') ?>
  <?= $form->field($model, 'alarmlog_simplified')->checkbox() ?>
  
  
    <?= $form->field($model, 'alarmlog_date')->checkbox() ?>

    <?php // echo $form->field($model, 'alarm_operator') ?>

    <?php // echo $form->field($model, 'alarm_reference') ?>

    <?php // echo $form->field($model, 'alarm_value') ?>

    <?php // echo $form->field($model, 'alarm_tolerance') ?>

    <?php // echo $form->field($model, 'alarm_reading_periodicity') ?>

    <?php // echo $form->field($model, 'alarm_limit') ?>

    <?php // echo $form->field($model, 'alarm_week_days') ?>

    <?php // echo $form->field($model, 'alarm_start_time') ?>

    <?php // echo $form->field($model, 'alarm_end_time') ?>

    <?php // echo $form->field($model, 'alarm_emails') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
