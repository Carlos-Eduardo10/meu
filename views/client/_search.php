<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\Client $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="client-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'client_name') ?>

    <?= $form->field($model, 'client_description') ?>

    <?= $form->field($model, 'client_date_register') ?>

    <?= $form->field($model, 'client_active')->checkbox() ?>

    <?php // echo $form->field($model, 'client_code') ?>

    <?php // echo $form->field($model, 'client_cnpj') ?>

    <?php // echo $form->field($model, 'client_zip_code') ?>

    <?php // echo $form->field($model, 'client_adress') ?>

    <?php // echo $form->field($model, 'client_country') ?>

    <?php // echo $form->field($model, 'client_state') ?>

    <?php // echo $form->field($model, 'client_city') ?>

    <?php // echo $form->field($model, 'client_latitude') ?>

    <?php // echo $form->field($model, 'client_longitude') ?>

    <?php // echo $form->field($model, 'client_image_url') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
