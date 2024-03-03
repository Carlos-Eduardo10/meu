<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Device $model */

$this->title = 'Update Device: ' . $model->device_id;
$this->params['breadcrumbs'][] = ['label' => 'Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->device_id, 'url' => ['view', 'device_id' => $model->device_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="device-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
