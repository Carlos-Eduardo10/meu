<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Resource $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="resource-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'resource_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'resource_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'resource_date_register')->textInput() ?>

    <?= $form->field($model, 'resource_slug')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
