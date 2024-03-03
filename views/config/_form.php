<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Config $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'config_date_register')->textInput() ?>

    <?= $form->field($model, 'config_table_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'config_table_id')->textInput() ?>

    <?= $form->field($model, 'config_type')->textInput() ?>

    <?= $form->field($model, 'config_value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'config_description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
