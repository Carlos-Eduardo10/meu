<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Network $model */

$this->title = 'Update Network: ' . $model->network_id;
$this->params['breadcrumbs'][] = ['label' => 'Networks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->network_id, 'url' => ['view', 'network_id' => $model->network_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="network-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
