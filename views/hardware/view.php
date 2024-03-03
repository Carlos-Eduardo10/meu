<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Hardware $model */

$this->title = $model->hardware_id;
$this->params['breadcrumbs'][] = ['label' => 'Hardwares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hardware-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'hardware_id' => $model->hardware_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'hardware_id' => $model->hardware_id], [
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
            'hardware_id',
            'hardware_name:ntext',
            'hardware_date_register',
        ],
    ]) ?>

</div>
