<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AlarmLog $model */

$this->title = 'Create Alarm Log';
$this->params['breadcrumbs'][] = ['label' => 'Alarm Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alarm-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
