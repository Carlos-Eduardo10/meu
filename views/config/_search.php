<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\Config $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="config-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'config_id') ?>

    <?= $form->field($model, 'config_date_register') ?>

    <?= $form->field($model, 'config_table_name') ?>

    <?= $form->field($model, 'config_table_id') ?>

    <?= $form->field($model, 'config_type') ?>

    <?php // echo $form->field($model, 'config_value') ?>

    <?php // echo $form->field($model, 'config_description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
