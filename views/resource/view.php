<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Resource $model */

$this->title = $model->resource_id;
$this->params['breadcrumbs'][] = ['label' => 'Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="resource-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'resource_id' => $model->resource_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'resource_id' => $model->resource_id], [
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
            'resource_id',
            'resource_name:ntext',
            'resource_description:ntext',
            'resource_date_register',
            'resource_slug:ntext',
        ],
    ]) ?>

</div>
