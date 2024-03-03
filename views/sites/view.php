<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Sites $model */

$this->title = $model->site_id;
$this->params['breadcrumbs'][] = ['label' => 'Sites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sites-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'site_id' => $model->site_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'site_id' => $model->site_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirma a remoção do item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'site_id',
            'site_name:ntext',
            'site_date_register',
            'site_active:boolean',
        ],
    ]) ?>

</div>
