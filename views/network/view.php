<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Network $model */

$this->title = $model->network_id;
$this->params['breadcrumbs'][] = ['label' => 'Networks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="network-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'network_id' => $model->network_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'network_id' => $model->network_id], [
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
            'network_id',
            'network_data_register',
            'network_name:ntext',
            'network_description:ntext',
            'network_slug:ntext',
        ],
    ]) ?>

</div>
