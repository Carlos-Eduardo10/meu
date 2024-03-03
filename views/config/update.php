<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Config $model */

$this->title = 'Update Config: ' . $model->config_id;
$this->params['breadcrumbs'][] = ['label' => 'Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->config_id, 'url' => ['view', 'config_id' => $model->config_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="config-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>