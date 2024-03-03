<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\LoginForm $model */

?>
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background: url(../assets/images/background/login-register.jpg) no-repeat center center; background-size: cover;">
    <div class="auth-box p-4 bg-white rounded">
        <div id="resetform">
            <div class="logo" style="align-items: center; text-align: center;">
                <img src="https://hml.admin.wenergy.com.br/assets/images/logo-w-login.png" width="60%" />
            </div>

            <div class="row">
                <div class="col-12">
                    <?php $form = ActiveForm::begin([
                        'id' => 'update-form',
                        'options' => [
                            'class' => 'form-horizontal mt-3 form-material',
                        ],
                    ]); ?>


                    <div class="form-group mb-4">
                        <div class="">
                            <?= $form->field($model, 'user_password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Senha', 'id' => 'input-password'])->label(false) ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="">
                            <?= $form->field($model, 'confirm_password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Confirmar Senha', 'id' => 'input-confirm-password'])->label(false) ?>
                        </div>
                    </div>



                    <div class="form-group text-center mt-4 mb-3">
                        <div class="col-xs-12">
                            <?= Html::submitButton('Salvar', ['class' => 'btn btn-info d-block w-100 waves-effect waves-light', 'name' => 'update-button']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

</script>