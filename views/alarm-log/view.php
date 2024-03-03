<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\AlarmLog $model */

$this->title = $model->alarmlog_id;
$this->params['breadcrumbs'][] = ['label' => 'Alarm Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="alarm-log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'alarmlog_id' => $model->alarmlog_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'alarmlog_id' => $model->alarmlog_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'alarmlog_id',
            'alarmlog_origin',
            'alarmlog_email:ntext',
            'alarmlog_table_name:ntext',
            'alarmlog_table_id',
            'alarmlog_status',
            'alarmlog_description:ntext',
            'alarmlog_type',
            'alarmlog_date',
            'alarmlog_simplified',
        ],
    ]) ?>

</div>
