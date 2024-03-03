<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Consumption $model */

$this->title = $model->consumption_id;
$this->params['breadcrumbs'][] = ['label' => 'Consumptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="consumption-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'consumption_id' => $model->consumption_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'consumption_id' => $model->consumption_id], [
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
            'consumption_id',
            'consumption_value',
            'consumption_date_register',
            'consumption_type',
            'consumption_reverse_pules',
            'consumption_circuit_temperature',
            'consumption_battery_voltage',
            'consumption_flags:ntext',
            'consumption_datetime',
            'consumption_full_value',
        ],
    ]) ?>

</div>
