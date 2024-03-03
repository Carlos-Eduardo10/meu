<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Message $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message_date_register')->textInput() ?>

    <?= $form->field($model, 'message_data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'message_time')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'message_seq_number')->textInput() ?>

    <?= $form->field($model, 'message_device_id')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
