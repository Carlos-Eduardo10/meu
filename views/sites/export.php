<?php

use yii\widgets\ActiveForm;
/** @var yii\web\View $this */
use app\models\Sites;

$this->title = 'Exportação de dados';
?>
<div class="page-wrapper">
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-md-5">
        <h3 class="page-title">Exportação de dados:</h3>
      </div>
      <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
        
      </div>
    </div>
  </div>
  <?php $form = ActiveForm::begin(['options' => ['id' => 'export-form']]); ?>
  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-md-8 single-note-item all-category note-business">
        <div class="card">
          <div class="card-body">
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" name="filtrar_sites" id="filtrar_sites" class="form-control" placeholder="Filtrar sites...">
                </div>
              </div>
            </div>
            <table id="sitesTable" class="table table-striped table-bordered display">
              <thead>
                <tr>
                  <th><input type="checkbox" id="checkbox-site" /></th>
                  <th>Site</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($sites as $key => $s) : ?>
              <?php
   
             $siteModel = Sites::findOne($key); 
             if ($siteModel && $siteModel->site_active) :
             ?>
            <tr>
            <td><input type="checkbox" name="export[]" value="<?= $key ?>" /></td>
            <td><?= $s ?></td>
           </tr>
           <?php endif; ?>
           <?php endforeach; ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4 single-note-item all-category note-business">
        <div class="card">
          <div class="card-body">
            <h6 class="card-subtitle lh-base">
              Tipo de exportação
            </h6>
            <select name="tipo_exportacao" id="tipo_exportacao" class="form-control">
              <option value="1" <?= ($type == 1) ? 'selected' : '' ?>>Medições de água</option>
              <option value="2" <?= ($type == 2) ? 'selected' : '' ?>>Medições de energia</option>
              <option value="3" <?= ($type == 3) ? 'selected' : '' ?>>Medições de Gás</option>
              <option value="4" <?= ($type == 4) ? 'selected' : '' ?>>Medições de Diesel</option>
              
            </select>
            <br>
            <h6 class="card-subtitle lh-base">
              Integralização
            </h6>
            <select name="tipo_integralizacao" class="form-control">
              <option value="1">Horária</option>
              <option value="2">Diária</option>
              <option value="3">Mensal</option>
            </select>
          </div>

          <div class="card-body">
            <h6 class="card-subtitle">
              Data inicial
            </h6>
            <input name="data_inicial" id="picker_from" class="form-control" type="date" /><br>
            <h6 class="card-subtitle">
              Data final
            </h6>
            <input name="data_final" id="picker_to" class="form-control" type="date" />
          </div>
          <button type="button" id="btn-export" class="btn waves-effect waves-light btn-success">Exportar</button>
        </div>
      </div>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
</div>

<?php

$this->registerJs("
$(document).ready(function(){
    $(document).on('input', '#filtrar_sites', function() {
        var filtroInput = $(this);
        var linhasTabela = $('.table tbody tr');
        var filtro = filtroInput.val().toLowerCase();

        linhasTabela.each(function() {
            var linha = $(this);
            var siteNome = linha.find('td:nth-child(2)').text().toLowerCase(); 

            if (siteNome.includes(filtro)) {
                linha.show(); 
            } else {
                linha.hide(); 
            }
        });
    });
    
});
");

$this->registerJs("
  $('#btn-export').click(function() {
    var formData = $('#export-form').submit();
  });
");

$this->registerJs("
  var checkboxSite = document.getElementById('checkbox-site');
  var checkboxes = document.querySelectorAll('input[type=\"checkbox\"]');

  checkboxSite.addEventListener('click', function() {
    var isChecked = checkboxSite.checked;

    checkboxes.forEach(function(checkbox) {
      checkbox.checked = isChecked;
    });
  });
");


