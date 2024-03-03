<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Hardware $model */

$this->title = 'Update Hardware: ' . $model->hardware_id;
$this->params['breadcrumbs'][] = ['label' => 'Hardwares', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hardware_id, 'url' => ['view', 'hardware_id' => $model->hardware_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hardware-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
