<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Hardware $model */

$this->title = 'Create Hardware';
$this->params['breadcrumbs'][] = ['label' => 'Hardwares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hardware-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
