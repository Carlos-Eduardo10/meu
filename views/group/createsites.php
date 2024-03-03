<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\GroupSite $model */
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal fade" id="vincularSiteModal" tabindex="-1" aria-labelledby="vincularSiteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vincularSiteModalLabel">Vincular Site</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Conteúdo do formulário para vincular o site -->
                <!-- ... -->
                <?= $this->render('_formsite', [
                        'model' => $model,
                        'query' => $query,
                    ]) ?>
            </div>
    </div>
</div>
</div>