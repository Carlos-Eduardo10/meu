<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Country $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="country-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'country_city_code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country_city_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country_state_code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country_code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country_state_name')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
