<?php

use app\models\AlarmLog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\AlarmLog $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Alarm Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alarm-log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Alarm Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'alarmlog_id',
            'alarmlog_origin',
            'alarmlog_email:ntext',
            'alarmlog_table_name:ntext',
            'alarmlog_table_id',
            //'alarmlog_status',
            //'alarmlog_description:ntext',
            //'alarmlog_type',
            'alarmlog_date',
            'alarmlog_simplified',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AlarmLog $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'alarmlog_id' => $model->alarmlog_id]);
                 }
            ],
        ],
    ]); ?>


</div>
