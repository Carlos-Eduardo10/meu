<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Device $model */

$this->title = $model->device_id;
$this->params['breadcrumbs'][] = ['label' => 'Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="device-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'device_id' => $model->device_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'device_id' => $model->device_id], [
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
            'device_id:ntext',
            'device_active:boolean',
            'device_date_register',
            'device_description:ntext',
        ],
    ]) ?>

</div>
