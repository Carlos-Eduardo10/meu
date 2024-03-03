<?php

use app\models\Consumption;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Consumption $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Consumptions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consumption-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Consumption', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'consumption_id',
            'consumption_value',
            'consumption_date_register',
            'consumption_type',
            'consumption_reverse_pules',
            //'consumption_circuit_temperature',
            //'consumption_battery_voltage',
            //'consumption_flags:ntext',
            //'consumption_datetime',
            //'consumption_full_value',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Consumption $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'consumption_id' => $model->consumption_id]);
                 }
            ],
        ],
    ]); ?>


</div>
