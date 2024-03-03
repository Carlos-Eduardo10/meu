<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Group $model */

$this->title = 'Novo Grupo';
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Novo Grupo</h3>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                  
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>