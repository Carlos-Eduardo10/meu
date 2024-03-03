<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Resource $model */

$this->title = 'Update Resource: ' . $model->resource_id;
$this->params['breadcrumbs'][] = ['label' => 'Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->resource_id, 'url' => ['view', 'resource_id' => $model->resource_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resource-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
