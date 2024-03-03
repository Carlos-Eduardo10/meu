<?php

use app\models\Alarm;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

/** @var app\models\Alarm $model */

$this->title = 'Criar e Configurar';
?>
<div class="page-wrapper">
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-md-5 align-self-center">
        <h3 class="page-title">Alarmes</h3>
        <div class="d-flex align-items-center">

        </div>
      </div>
      <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
        <div class="d-flex">
          <a href="/alarm/create" class="btn btn-success">
            <i data-feather="plus" class="fill-white feather-sm"></i>
            Novo Alarme
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid note-has-grid">
    <ul class="nav nav-pills p-3 bg-white mb-3 align-items-center">
      <li class="nav-item">
        <a href="/alarm" class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2" id="note-business">
          <i data-feather="bell" class="feather-sm fill-white me-0 me-md-1"></i>
          <span class="d-none d-md-block font-weight-medium ">
            Ocorrências
          </span>
        </a>
      </li>
      <li class="nav-item">
        <a href="/alarm/criar" class=" nav-link rounded-pill note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2 active " id="note-social">
          <i data-feather="sliders" class="feather-sm fill-white me-0 me-md-1">
          </i>
          <span class="d-none d-md-block font-weight-medium">
            Criar e configurar
          </span>
        </a>
      </li>
    </ul>

    <div class="tab-content">
      <div class="col-md-12 single-note-item all-category note-business">
        <div class="card">
          <div class="card-body">
            <?= GridView::widget([
              'dataProvider' => $dataProvider,
              'filterModel' => $searchModel,
              'columns' => [
                'alarm_name',
                [
                  'attribute' => 'alarm_type',
                  'value' => function ($model) {
                      return $model->getAlarmTypeLabel();
                  },
                ],
                [
                  'attribute' => 'alarm_active',
                  'value' => function ($model) {
                      return $model->getAlarmActiveLabel();
                  },
                ],
                'alarm_value',
                [
                  'class' => ActionColumn::className(),
                  'template' => ' {update} {delete}',
                  'urlCreator' => function ($action, Alarm $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'alarm_id' => $model->alarm_id]);
                },
                ]
              ],

            ]); ?>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
