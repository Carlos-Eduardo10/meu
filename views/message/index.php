<?php

use app\models\Message;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Message $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'message_id',
            'message_date_register',
            'message_data:ntext',
            'message_time:ntext',
            'message_seq_number',
            //'message_device_id:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Message $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'message_id' => $model->message_id]);
                 }
            ],
        ],
    ]); ?>


</div>
