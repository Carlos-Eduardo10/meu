<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AlarmLog $model */

$this->title = 'Update Alarm Log: ' . $model->alarmlog_id;
$this->params['breadcrumbs'][] = ['label' => 'Alarm Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->alarmlog_id, 'url' => ['view', 'alarmlog_id' => $model->alarmlog_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alarm-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
