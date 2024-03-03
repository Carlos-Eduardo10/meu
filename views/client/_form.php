<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Client $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'client_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'client_date_register')->textInput() ?>

    <?= $form->field($model, 'client_active')->checkbox() ?>

    <?= $form->field($model, 'client_code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'client_cnpj')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'client_zip_code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'client_adress')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'client_country')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'client_state')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'client_city')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'client_latitude')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'client_longitude')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'client_image_url')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
