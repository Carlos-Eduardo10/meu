<?php

use app\models\Group;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Group $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'group_name')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'group_resource_type')->dropDownList(
                Group::GroupResources()
            ) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'group_active')->dropDownList([true => 'ATIVO', false => 'INATIVO']) ?>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>