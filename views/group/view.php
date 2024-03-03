<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Group $model */

$this->title = $model->group_id;
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="group-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Editar', ['update', 'group_id' => $model->group_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'group_id' => $model->group_id], [
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
            'group_id',
            'group_name:ntext',
            'group_active:ntext',
            'group_date_register',
            'group_client_id',
        ],
    ]) ?>

</div>
