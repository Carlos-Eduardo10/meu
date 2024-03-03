<?php

use app\models\Goal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Goal $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Goals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Goal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'goal_id',
            'goal_name:ntext',
            'goal_description:ntext',
            'goal_date_register',
            'goal_type',
            //'goal_year',
            //'goal_percentage_min',
            //'goal_percentage_max',
            //'goal_value',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Goal $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'goal_id' => $model->goal_id]);
                 }
            ],
        ],
    ]); ?>


</div>
