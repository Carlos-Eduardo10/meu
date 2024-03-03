<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\GroupSite $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sites-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
            <?= $form->field($model, 'fk_group_id')->hiddenInput(['value' => Yii::$app->request->get('id')])->label(false) ?>
        <div class="col-md-12">
            <?= $form->field($model, 'fk_site_id')->label('Site:')->dropDownList(ArrayHelper::map($query->all(), 'site_id', 'site_name'),['prompt' => 'Selecione']) ?>
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