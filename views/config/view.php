<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Config $model */

$this->title = $model->config_id;
$this->params['breadcrumbs'][] = ['label' => 'Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="config-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'config_id' => $model->config_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'config_id' => $model->config_id], [
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
            'config_id',
            'config_date_register',
            'config_table_name:ntext',
            'config_table_id',
            'config_type',
            'config_value:ntext',
            'config_description:ntext',
        ],
    ]) ?>

</div>
