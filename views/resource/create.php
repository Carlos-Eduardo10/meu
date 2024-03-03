<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Resource $model */

$this->title = 'Create Resource';
$this->params['breadcrumbs'][] = ['label' => 'Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
