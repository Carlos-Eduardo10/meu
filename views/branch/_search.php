<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\Branch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="branch-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'branch_id') ?>

    <?= $form->field($model, 'branch_name') ?>

    <?= $form->field($model, 'branch_description') ?>

    <?= $form->field($model, 'branch_date_register') ?>

    <?= $form->field($model, 'branch_active')->checkbox() ?>

    <?php // echo $form->field($model, 'branch_code') ?>

    <?php // echo $form->field($model, 'branch_cnpj') ?>

    <?php // echo $form->field($model, 'branch_zip_code') ?>

    <?php // echo $form->field($model, 'branch_adress') ?>

    <?php // echo $form->field($model, 'branch_country') ?>

    <?php // echo $form->field($model, 'branch_state') ?>

    <?php // echo $form->field($model, 'branch_city') ?>

    <?php // echo $form->field($model, 'branch_latitude') ?>

    <?php // echo $form->field($model, 'branch_longitude') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
