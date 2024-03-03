<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Sites $model */

$this->title = 'Update Sites: ' . $model->site_id;
$this->params['breadcrumbs'][] = ['label' => 'Sites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->site_id, 'url' => ['view', 'site_id' => $model->site_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sites-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
