<?php

use app\models\Client;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Client $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Client', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'client_id',
            'client_name:ntext',
            'client_description:ntext',
            'client_date_register',
            'client_active:boolean',
            //'client_code:ntext',
            //'client_cnpj:ntext',
            //'client_zip_code:ntext',
            //'client_adress:ntext',
            //'client_country:ntext',
            //'client_state:ntext',
            //'client_city:ntext',
            //'client_latitude:ntext',
            //'client_longitude:ntext',
            //'client_image_url:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Client $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'client_id' => $model->client_id]);
                 }
            ],
        ],
    ]); ?>


</div>
