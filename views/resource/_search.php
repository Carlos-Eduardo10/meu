<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\Resource $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="resource-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'resource_id') ?>

    <?= $form->field($model, 'resource_name') ?>

    <?= $form->field($model, 'resource_description') ?>

    <?= $form->field($model, 'resource_date_register') ?>

    <?= $form->field($model, 'resource_slug') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
