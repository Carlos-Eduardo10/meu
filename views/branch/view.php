<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Branch $model */

$this->title = $model->branch_id;
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="branch-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'branch_id' => $model->branch_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'branch_id' => $model->branch_id], [
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
            'branch_id',
            'branch_name:ntext',
            'branch_description:ntext',
            'branch_date_register',
            'branch_active:boolean',
            'branch_code:ntext',
            'branch_cnpj:ntext',
            'branch_zip_code:ntext',
            'branch_adress:ntext',
            'branch_country:ntext',
            'branch_state:ntext',
            'branch_city:ntext',
            'branch_latitude:ntext',
            'branch_longitude:ntext',
        ],
    ]) ?>

</div>
