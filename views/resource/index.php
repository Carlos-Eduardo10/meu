<?php

use app\models\Resource;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Resource $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Resources';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Resource', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'resource_id',
            'resource_name:ntext',
            'resource_description:ntext',
            'resource_date_register',
            'resource_slug:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Resource $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'resource_id' => $model->resource_id]);
                 }
            ],
        ],
    ]); ?>


</div>
