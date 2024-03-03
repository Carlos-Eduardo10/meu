<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\Message $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="message-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'message_id') ?>

    <?= $form->field($model, 'message_date_register') ?>

    <?= $form->field($model, 'message_data') ?>

    <?= $form->field($model, 'message_time') ?>

    <?= $form->field($model, 'message_seq_number') ?>

    <?php // echo $form->field($model, 'message_device_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
