<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Client $model */

$this->title = $model->client_id;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="client-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'client_id' => $model->client_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'client_id' => $model->client_id], [
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
            'client_id',
            'client_name:ntext',
            'client_description:ntext',
            'client_date_register',
            'client_active:boolean',
            'client_code:ntext',
            'client_cnpj:ntext',
            'client_zip_code:ntext',
            'client_adress:ntext',
            'client_country:ntext',
            'client_state:ntext',
            'client_city:ntext',
            'client_latitude:ntext',
            'client_longitude:ntext',
            'client_image_url:ntext',
        ],
    ]) ?>

</div>
