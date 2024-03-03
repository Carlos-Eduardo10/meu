<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Goal $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="goal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'goal_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'goal_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'goal_date_register')->textInput() ?>

    <?= $form->field($model, 'goal_type')->textInput() ?>

    <?= $form->field($model, 'goal_year')->textInput() ?>

    <?= $form->field($model, 'goal_percentage_min')->textInput() ?>

    <?= $form->field($model, 'goal_percentage_max')->textInput() ?>

    <?= $form->field($model, 'goal_value')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
