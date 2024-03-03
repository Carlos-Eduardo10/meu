<?php

use app\models\Branch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Branch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Branch', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'branch_id',
            'branch_name:ntext',
            'branch_description:ntext',
            'branch_date_register',
            'branch_active:boolean',
            //'branch_code:ntext',
            //'branch_cnpj:ntext',
            //'branch_zip_code:ntext',
            //'branch_adress:ntext',
            //'branch_country:ntext',
            //'branch_state:ntext',
            //'branch_city:ntext',
            //'branch_latitude:ntext',
            //'branch_longitude:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Branch $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'branch_id' => $model->branch_id]);
                 }
            ],
        ],
    ]); ?>


</div>
