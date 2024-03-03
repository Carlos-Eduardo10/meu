<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Branch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="branch-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'branch_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'branch_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'branch_date_register')->textInput() ?>

    <?= $form->field($model, 'branch_active')->checkbox() ?>

    <?= $form->field($model, 'branch_code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'branch_cnpj')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'branch_zip_code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'branch_adress')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'branch_country')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'branch_state')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'branch_city')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'branch_latitude')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'branch_longitude')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
