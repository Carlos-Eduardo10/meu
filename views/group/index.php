<?php

//Excluir a linha abaixo para retirar redirect
\Yii::$app->response->redirect(['sites']);

use app\models\Group;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\Group $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Grupos';
$this->params['breadcrumbs'][] = $this->title;


?>


<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Sites/Grupos:</h3>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    <a href="/group/create" class="btn btn-success">
                        <i data-feather="plus" class="fill-white feather-sm"></i>
                        Novo Grupo
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid note-has-grid">
        <?= $this->render('@app/views/layouts/sitesMenu'); ?>
        <div class="note-has-grid row">
            <div class="col-md-12">
                <div class="card card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            'group_id',
                            [
                                'attribute' => 'group_resource_type',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'group_resource_type',
                                    Group::GroupResources(),
                                    ['class' => 'form-control', 'prompt' => 'Selecione...']
                                ),
                                'value' => function ($model) {
                                    $data =  Group::GroupResourcesLabels($model->group_resource_type);
                                    if ($data) {
                                        return $data;
                                    }

                                    return false;
                                }
                            ],
                            'group_name',
                            'totalSites',
                            [
                                'attribute' => 'group_active',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList(
                                    $searchModel,
                                    'group_active',
                                    [
                                        1 => 'Ativo',
                                        2 => 'Inativo'
                                    ],
                                    ['class' => 'form-control', 'prompt' => 'Selecione...']
                                ),
                                'value' => function ($model) {
                                    return $model->group_active ? '<span class="badge bg-success">ATIVO</span>' : '<span class="badge bg-danger">INATIVO</span>';
                                }
                            ],
                            [
                                'class' => ActionColumn::className(),
                                'template' => '{data} {sites} {update} {delete}',
                                'urlCreator' => function ($action, Group $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'group_id' => $model->group_id]);
                                },
                                'buttons' => [
                                    'data' => function ($url, $model, $key) {
                                        $url = Url::to(['sites/seleciona-grupo', 'id' => $model->group_id]);
                                        if($model->totalSites > 0) {
                                            return Html::a('<span class="fa fa-chart-pie ml-4"></span>', $url, [
                                                'title' => 'Relatórios',
                                            ]);
                                        }
                                        return false;
                                    },
                                    'sites' => function ($url, $model, $key) {
                                        $url = Url::to(['group/sites', 'id' => $model->group_id]);
                                        return Html::a('<span class="fas fa-align-justify mr-4"></span>', $url, [
                                            'title' => 'Sites',
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