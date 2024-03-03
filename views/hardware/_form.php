<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Hardware $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="hardware-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hardware_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hardware_date_register')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
