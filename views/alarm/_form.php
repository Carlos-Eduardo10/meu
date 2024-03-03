<?php

use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var app\models\Alarm $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alarm-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row mb-3">
        <div class="col-md-2">
            <?= $form->field($model, 'alarm_active')->widget(SwitchInput::classname(), [
                'type' => SwitchInput::CHECKBOX
            ]) ?>
        </div>
        <div class="col-md-10">
            <?= $form->field($model, 'alarm_name')->textInput() ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <?= $form->field($model, 'alarm_type_point')->dropDownList(['1' => 'Água']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'alarm_type')->dropDownList(['1' => 'Volume Consumido', '2' => 'Vazão']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'alarm_operator')->dropDownList(['1' => 'Maior que', '2' => 'Menor que']) ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <?= $form->field($model, 'alarm_value')->textInput(['type' => 'number', 'step' => '0.01']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'alarm_tolerance')->textInput(['type' => 'number', 'step' => '0.01'])->label('Tolerância (%)') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'alarm_reading_periodicity')->dropDownList(['1' => 'Horário']) ?>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <?= $form->field($model, 'site_id')->widget(Select2::classname(), [
                'data' => $query1,
                'options' => ['multiple' => true, 'placeholder' => 'Selecione'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]) ?>
        </div>
    </div>

    <div class="wee">
        <div class="row">
            <div class="col-md-12">
                <h4> Periodicidade do alarme</h4>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <?= $form->field($model, 'alarm_week_days', ['template' => "{input}\n{hint}\n{error}"])->checkboxList([
                    'sunday' => 'Domingo',
                    'monday' => 'Segunda-feira',
                    'tuesday' => 'Terça-feira',
                    'wednesday' => 'Quarta-feira',
                    'thursday' => 'Quinta-feira',
                    'friday' => 'Sexta-feira',
                    'saturday' => 'Sábado'
                ], [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return "" .
                            "<div class='form-check'>" .
                            "<input class='form-check-input' type='checkbox' name='{$name}' value='{$value}' " . ($checked ? 'checked' : '') . ">" .
                            "<label class='form-check-label' for='{$value}'>{$label}</label>" .
                            "</div>";
                    }
                ]) ?>
            </div>
        </div>
        <div class="row mb-3">
    <div class="col-md-3">
        <?= $form->field($model, 'alarm_start_time')->input('time', [
            'class' => 'form-control',
            'placeholder' => 'HH:MM',
        ]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'alarm_end_time')->input('time', [
            'class' => 'form-control',
            'placeholder' => 'HH:MM',
        ]) ?>
    </div>
</div>
    </div>
    <div class="row mt-3 mb-3">
        <div class="col-md-12">
            <?= $form->field($model, 'alarm_emails')->widget(Select2::classname(), [
                'options' => ['placeholder' => 'Digite...', 'multiple' => true],
                'pluginOptions' => [
                    'tags' => true,
                    'tokenSeparators' => [',', ' ', '\t'],
                    'allowClear' => false,
                ],
            ]) ?>
            <p> Use a tecla de espaço, enter ou vírgual para adicionar os e-mails.</p>
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