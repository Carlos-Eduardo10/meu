<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Network $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="network-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'network_data_register')->textInput() ?>

    <?= $form->field($model, 'network_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'network_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'network_slug')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
