<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\Network $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="network-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'network_id') ?>

    <?= $form->field($model, 'network_data_register') ?>

    <?= $form->field($model, 'network_name') ?>

    <?= $form->field($model, 'network_description') ?>

    <?= $form->field($model, 'network_slug') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
