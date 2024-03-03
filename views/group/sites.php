<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\SitesGroup $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\SitesGroup $model */

$this->title = 'Sites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-wrapper">
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-md-5 align-self-center">
        <h3 class="page-title">[<?= $group->group_name ?>] - Gerenciar sites vinculados</h3>
      </div>
    </div>
  </div>
  <div class="container-fluid note-has-grid">
  <?= $this->render('@app/views/group/createsites', ['model' => $model, 'query' => $query]); ?>
  <a href="#" class="btn btn-primary btn-sm mb-2 mt-4" data-bs-toggle="modal" data-bs-target="#vincularSiteModal">Vincular Site</a>
    <a href="/group" class="btn btn-primary btn-sm mb-2 mt-4">Voltar para os grupos</a>
    <div class="note-has-grid row">
      <div class="col-md-12">
        <div class="card card-body">
          <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
              'site_name:ntext',
              [
                'attribute' => 'site_active',
                'format' => 'raw',
                'value' => function ($model) {
                  return $model->site_active ? '<span class="badge bg-success">ATIVO</span>' : '<span class="badge bg-danger">INATIVO</span>';
                }
              ],
              [
                'class' => ActionColumn::class,
                'template' => '{deletesite}',
                'buttons' => [
                  'deletesite' => function ($url, $model, $key) {
                      $url = ['group/deletesite', 'id' => $model->site_id]; // Rota para a ação de exclusão
                      return Html::a('<span class="fa fa-trash"></span>', $url, [
                          'title' => 'Excluir',
                          'data' => [
                              'confirm' => 'Tem certeza que deseja excluir este item?', // Mensagem de confirmação
                              'method' => 'post',
                          ],
                      ]);
                    },
                ],
              ],
            ],
          ]); ?>
        </div>
      </div>
    </div>
  </div>
</div>