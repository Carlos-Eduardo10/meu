<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Message $model */

$this->title = $model->message_id;
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="message-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'message_id' => $model->message_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'message_id' => $model->message_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'message_id',
            'message_date_register',
            'message_data:ntext',
            'message_time:ntext',
            'message_seq_number',
            'message_device_id:ntext',
        ],
    ]) ?>

</div>
