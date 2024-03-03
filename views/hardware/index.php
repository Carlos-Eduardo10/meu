<?php

use app\models\Hardware;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Hardware $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Hardwares';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hardware-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Hardware', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'hardware_id',
            'hardware_name:ntext',
            'hardware_date_register',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Hardware $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'hardware_id' => $model->hardware_id]);
                 }
            ],
        ],
    ]); ?>


</div>
