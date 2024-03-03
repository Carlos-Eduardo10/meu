<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Alarm $model */

$this->title = 'Configuração do alarme';
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Cadastro de Alarme</h3>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    <a href="/alarm/criar" class="btn btn-primary btn-sm">
                        <i data-feather="plus" class="fill-white feather-sm"></i>
                        Voltar para os alarmes
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid note-has-grid">
        <div class="col-md-12 single-note-item all-category note-business">
            <div class="card">
                <div class="card-body">
                    <?= $this->render('_form', [
                        'model' => $model,
                        'query1' => $query1,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>