<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\LoginForm $model */

?>
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background: url(../assets/images/background/login-register.jpg) no-repeat center center; background-size: cover;">
    <div class="auth-box p-4 bg-white rounded">
        <div id="loginform">
            <div class="logo" style="align-items: center; text-align: center;">
                <img src="https://hml.admin.wenergy.com.br/assets/images/logo-w-login.png" width="60%" />
            </div>

            <div class="row">
                <div class="col-12">
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'options' => [
                            'class' => 'form-horizontal mt-3 form-material',
                        ],
                    ]); ?>

                    <div class="form-group mb-3">
                        <div class="">
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => 'Usuário', 'id' => 'input-login'])->label(false) ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="">
                            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Senha', 'id' => 'input-password'])->label(false) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-flex">
                            <div class="checkbox checkbox-info pt-0">
                            </div>
                            <div class="ms-auto">
                                <a href="javascript:void(0)" id="to-recover" class="link font-weight-medium"><i class="fa fa-lock me-1"></i> Esqueceu sua senha?</a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center mt-4 mb-3">
                        <div class="col-xs-12">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-info d-block w-100 waves-effect waves-light', 'name' => 'login-button']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

        <div id="recoverform">
            <div class="logo">
                <h3 class="font-weight-medium mb-3">Recuperar senha</h3>
                <span class="text-muted">Digite seu e-mail e as instruções serão enviadas para você!</span>
            </div>
            <div class="row mt-3 form-material">
                <!-- Form -->
                <!-- <form id="password-reset-form" class="col-12"> -->
                <?php $form = ActiveForm::begin([
                        'id' => 'reset-form',
                        'options' => [
                            'class' => 'form-horizontal mt-3 form-material',
                        ],
                    ]); ?>
                    <!-- email -->
                    <div class="form-group row">
                        <div class="col-12">
                            <!-- <input id="email" class="form-control" type="email" required="" placeholder="E-mail" /> -->
                            <?= $form->field($model1, 'email')->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => 'E-mail', 'id' => 'input-email'])->label(false) ?>
                        </div>
                    </div>
                    <!-- pwd -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <!-- <button class="btn d-block w-100 btn-primary text-uppercase" type="submit" name="action">
                                Reset
                            </button> -->
                            <?= Html::submitButton('Reset', ['class' => 'btn btn-info d-block w-100 waves-effect waves-light', 'name' => 'reset-button']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>



    $("#to-recover").on("click", function() {
        $("#login-form").slideUp();
        $("#recoverform").fadeIn();
    });
</script>