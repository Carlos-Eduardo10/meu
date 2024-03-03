<?php

use app\models\Device;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Device $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Devices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-wrapper">
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-md-5 align-self-center">
        <h3 class="page-title">Devices: </h3>
      </div>
    </div>
  </div>
  <div class="container-fluid note-has-grid">
  <a href="/sites" class="btn btn-primary btn-sm mb-2 mt-4">Voltar para os sites</a>
  <div class="note-has-grid row">
      <div class="col-md-12">
        <div class="card card-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'device_id:ntext',
            [
              'attribute' => 'device_active',
              'format' => 'raw',
              'value' => function ($model) {
                return $model->device_active ? '<span class="badge bg-success">ATIVO</span>' : '<span class="badge bg-danger">INATIVO</span>';
              }
            ],
            'device_description:ntext',
        ],
    ]); ?>

</div>
      </div>
    </div>
  </div>
</div>
