<?php

use app\models\Network;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Network $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Networks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="network-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Network', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'network_id',
            'network_data_register',
            'network_name:ntext',
            'network_description:ntext',
            'network_slug:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Network $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'network_id' => $model->network_id]);
                 }
            ],
        ],
    ]); ?>


</div>
