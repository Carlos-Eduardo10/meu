<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AlarmLog $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alarm-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alarmlog_origin')->textInput() ?>

    <?= $form->field($model, 'alarmlog_email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'alarmlog_table_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'alarmlog_table_id')->textInput() ?>

    <?= $form->field($model, 'alarmlog_status')->textInput() ?>

    <?= $form->field($model, 'alarmlog_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'alarmlog_type')->textInput() ?>

  

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
