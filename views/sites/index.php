<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Sites $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sites';
$this->params['breadcrumbs'][] = $this->title;

$dataProvider->query->andWhere([
    'site_active' => true,
    'site_id' => Yii::$app->db->createCommand("
        SELECT site_id
        FROM telemetria.m_view_site_last_message
    ")->queryColumn(),
]);
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Sites/Grupos:</h3>
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
                            [
                                'attribute' => 'site_name',
                                'label' => 'Nome ',
                                'value' => function ($model) {
                                    // Obtém o nome do site
                                    return $model->site_active ? $model->site_name : '';
                                },
                                'filter' => Html::activeTextInput($searchModel, 'site_name', ['class' => 'form-control']),
                                'filterOptions' => ['class' => 'position-relative'], // Adiciona esta linha


                            ],
                            [
                                'attribute' => 'site_active',
                                'label' => 'Última leitura',
                                'value' => function ($model) {
                                    // Verifica se há dados na última leitura do site
                                    $hasData = Yii::$app->db->createCommand("
                                        SELECT COUNT(*)
                                        FROM telemetria.m_view_site_last_message
                                        WHERE site_id = :siteId
                                    ", [':siteId' => $model->site_id])->queryScalar();

                                    if ($hasData > 0) {
                                        $result = Yii::$app->db->createCommand("
                                            SELECT (message_date_register - interval '3 hour') as message_date_register
                                            FROM telemetria.m_view_site_last_message
                                            WHERE site_id = :siteId
                                            ORDER BY message_date_register DESC
                                            LIMIT 1
                                        ", [':siteId' => $model->site_id])->queryScalar();

                                        $GLOBALS['message_date_register'] = $result;
                                        return ($result !== false && $result !== null) ? date('d/m/Y H:i:s', strtotime($result)) : '';
                                    } else {
                                        $GLOBALS['message_date_register'] = null;
                                        return '';
                                    }
                                },
                            ],
                            [
                                'attribute' => 'site_status',
                                'label' => 'Status',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    $hasData = !is_null($GLOBALS['message_date_register']);

                                    if ($hasData) {
                                        $result = $GLOBALS['message_date_register'];
                                        $date1 = new DateTime($result);
                                        $date2 = new DateTime(date("Y-m-d H:i:s"));
                                        $diff = $date2->diff($date1);
                                        $hours = $diff->h;
                                        $hours = $hours + ($diff->days * 24);

                                        return ($hours <= 4) ? '<span class="badge bg-success">On</span>' : '<span class="badge bg-danger">Off</span>';
                                    } else {
                                        return '';
                                    }
                                },
                            ],
                            [
                                'class' => ActionColumn::class,
                                'template' => '{data}',
                                'buttons' => [
                                    'devices' => function ($url, $model, $key) {
                                        $hasData = !is_null($GLOBALS['message_date_register']);

                                        if ($hasData) {
                                            $siteId = $model->site_id;
                                            $url = Url::to(['device/index', 'id' => $siteId]);
                                            return Html::a('<span class="fa fa-microchip mr-4"></span>', $url, [
                                                'title' => 'Devices',
                                            ]);
                                        } else {
                                            return '';
                                        }
                                    },
                                    'data' => function ($url, $model, $key) {
                                        $hasData = !is_null($GLOBALS['message_date_register']);

                                        if ($hasData) {
                                            $siteId = $model->site_id;
                                            $url = Url::to(['sites/seleciona-site', 'id' => $siteId]);
                                            return Html::a('<span class="fa fa-chart-pie ml-4"></span>', $url, [
                                                'title' => 'Relatórios',
                                                'data-url' => $url, // Adiciona o atributo data-url com a URL do relatório
                                            ]);
                                        } else {
                                            return '';
                                        }
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






