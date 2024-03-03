<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_active')->checkbox() ?>

    <?= $form->field($model, 'user_date_register')->textInput() ?>

    <?= $form->field($model, 'user_password')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_type')->textInput() ?>

    <?= $form->field($model, 'user_first_login')->checkbox() ?>

    <?= $form->field($model, 'user_token')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
