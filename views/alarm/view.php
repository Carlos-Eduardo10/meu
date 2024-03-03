<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Alarm $model */

$this->title = $model->alarm_id;
$this->params['breadcrumbs'][] = ['label' => 'Alarms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="alarm-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'alarm_id' => $model->alarm_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'alarm_id' => $model->alarm_id], [
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
            'alarm_id',
            'alarm_name:ntext',
            'alarm_description:ntext',
            'alarm_type',
            'alarm_active:boolean',
            'alarm_operator',
            'alarm_reference',
            'alarm_value',
            'alarm_tolerance',
            'alarm_reading_periodicity',
            'alarm_limit',
            'alarm_week_days:ntext',
            'alarm_start_time',
            'alarm_end_time',
            'alarm_emails:ntext',
            'alarmlog_date',
            'alarmlog_simplified'
            
        ],
    ]) ?>

</div>
