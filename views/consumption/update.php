<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Consumption $model */

$this->title = 'Update Consumption: ' . $model->consumption_id;
$this->params['breadcrumbs'][] = ['label' => 'Consumptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->consumption_id, 'url' => ['view', 'consumption_id' => $model->consumption_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="consumption-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
