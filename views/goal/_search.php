<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\Goal $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="goal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'goal_id') ?>

    <?= $form->field($model, 'goal_name') ?>

    <?= $form->field($model, 'goal_description') ?>

    <?= $form->field($model, 'goal_date_register') ?>

    <?= $form->field($model, 'goal_type') ?>

    <?php // echo $form->field($model, 'goal_year') ?>

    <?php // echo $form->field($model, 'goal_percentage_min') ?>

    <?php // echo $form->field($model, 'goal_percentage_max') ?>

    <?php // echo $form->field($model, 'goal_value') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
