<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Goal $model */

$this->title = $model->goal_id;
$this->params['breadcrumbs'][] = ['label' => 'Goals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="goal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'goal_id' => $model->goal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'goal_id' => $model->goal_id], [
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
            'goal_id',
            'goal_name:ntext',
            'goal_description:ntext',
            'goal_date_register',
            'goal_type',
            'goal_year',
            'goal_percentage_min',
            'goal_percentage_max',
            'goal_value',
        ],
    ]) ?>

</div>
