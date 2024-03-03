<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Goal $model */

$this->title = 'Update Goal: ' . $model->goal_id;
$this->params['breadcrumbs'][] = ['label' => 'Goals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->goal_id, 'url' => ['view', 'goal_id' => $model->goal_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="goal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
