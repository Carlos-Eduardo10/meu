<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Sites $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sites-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'site_name')->textInput(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'site_active')->dropDownList([true => 'ATIVO', false => 'INATIVO']) ?>
        </div>
    </div>
    <div class="row" style="margin-top: 10px; margin-bottom:10px">
        <div class="col-md-12">
            <?= $form->field($model, 'site_date_register')->textInput(['type' => 'date']) ?>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>