<?php

/** @var yii\web\View $this */

use app\models\Sites;

$ymensal = (Yii::$app->request->get('ymensal') && Yii::$app->request->get('ymensal') > 0)
  ? Yii::$app->request->get('ymensal')
  : date("Y");

$ydiario = (Yii::$app->request->get('ydiario') && Yii::$app->request->get('ydiario') > 0)
  ? Yii::$app->request->get('ydiario')
  : date("m-Y");

$chorario = (Yii::$app->request->get('chorario') && Yii::$app->request->get('chorario') > 0)
  ? Yii::$app->request->get('chorario')
  : date("d-m-Y");

$chorarioAcu = (Yii::$app->request->get('chorarioAcu') && Yii::$app->request->get('chorarioAcu') > 0)
  ? Yii::$app->request->get('chorarioAcu')
  : date("d-m-Y");


$ydiarioacumulado = (Yii::$app->request->get('ydiarioacumulado') && Yii::$app->request->get('ydiarioacumulado') > 0)
  ? Yii::$app->request->get('ydiarioacumulado')
  : date("m-Y");

 
?>
<div class="page-wrapper">
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-md-8 align-self-center">
        <h3 class="page-title"><?= Sites::retornaNomeBusca() ?></h3>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Energia2</a></li>
              <li class="breadcrumb-item active" aria-current="page">
                Consolidado
              </li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="col-md-4 justify-content-end align-self-center d-none d-md-flex">
        <div class="d-flex">
          <div class="dropdown me-2 mr-4"> Dashboard
            <button class="btn btn-success dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
              Principal
            </button>           
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="card">
          <div class="card-body">
            <?php if ($consumoEnergiaDoDia['consume'] != 0) : ?>
              <div class="row">
                <div class="col-8">
                  <span style="font-size:22px;" class="display-6"><?= $consumoEnergiaDoDia['consume'] ?> kWh <br>
                    <i class="ti-angle-<?= ($consumoEnergiaDoDia['consume'] <= $consumoEnergiaDoDia['average']) ? 'up' : 'down' ?> fs-3 text-<?= ($consumoEnergiaDoDia['consume'] <= $consumoEnergiaDoDia['average']) ? 'success' : 'danger' ?>">
                      <span style="font-family:Arial">
                        <?=
                        ($consumoEnergiaDoDia['consume'] && $consumoEnergiaDoDia['consume'] > 0)
                          ? round($consumoEnergiaDoDia['average'] * 100 / $consumoEnergiaDoDia['consume'], 2)
                          : 0; ?>%
                      </span>
                    </i>
                  </span>
                  <h6 style="font-size:12px; font-weight:bold;">Consumo total (dia)</h6>
                </div>
                <div class="col-4 align-self-center text-end pl-0 text-<?= ($consumoEnergiaDoDia['consume'] <= $consumoEnergiaDoDia['average']) ? 'primary' : 'danger' ?>">
                  <i data-feather="bar-chart-2" class="feather-icon  fa-dash"></i>
                </div>
              </div>
            <?php else : ?>
              <div class="row">
                <div class="col-8">
                  <span style="font-size:22px;" class="display-6">0 kWh <br></span>
                  <h6 style="font-size:12px; font-weight:bold;">Consumo total (dia)</h6>
                </div>
                <div class="col-4 align-self-center text-end pl-0 text-muted">
                  <i data-feather="bar-chart-2" class="feather-icon  fa-dash"></i>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card">
          <div class="card-body">
            <?php if ($consumoEnergiaDoMes['consume'] != 0) : ?>
              <div class="row">
                <div class="col-8">
                  <span style="font-size:22px;" class="display-6"><?= $consumoEnergiaDoMes['consume'] ?> kWh <br>
                    <i class="ti-angle-<?= ($consumoEnergiaDoMes['consume'] <= $consumoEnergiaDoMes['average']) ? 'up' : 'down' ?> fs-3 text-<?= ($consumoEnergiaDoMes['consume'] <= $consumoEnergiaDoMes['average']) ? 'success' : 'danger' ?>">
                      <span style="font-family:Arial">
                        <?php $averageConsumption = 0;
                        if ($consumoEnergiaDoMes['consume'] != 0) {
                          $averageConsumption = round($consumoEnergiaDoMes['average'] * 100 / $consumoEnergiaDoMes['consume'], 2);
                        }
                        echo $averageConsumption;
                        ?>%</span>
                    </i>
                  </span>
                  <h6 style="font-size:12px; font-weight:bold;">Consumo total (mês)</h6>
                </div>
                <div class="col-4 align-self-center text-end pl-0 text-<?= ($consumoEnergiaDoMes['consume'] <= $consumoEnergiaDoMes['average']) ? 'primary' : 'danger' ?>">
                  <i data-feather="bar-chart-2" class="feather-icon  fa-dash"></i>
                </div>
              </div>
            <?php else : ?>
              <div class="row">
                <div class="col-8">
                  <span style="font-size:22px;" class="display-6">0 kWh <br></span>
                  <h6 style="font-size:12px; font-weight:bold;">Consumo total (mês)</h6>
                </div>
                <div class="col-4 align-self-center text-end pl-0 text-muted">
                  <i data-feather="bar-chart-2" class="feather-icon  fa-dash"></i>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-8">
                <span style="font-size:22px;" class="display-6"><?= $ultimaLeituraConsumoEnergia['lastConsume'] ?> kWh <br>
                </span>
                <h6 style="font-size:12px; font-weight:bold;">Última leitura consumo</h6>
              </div>
              <div class="col-4 align-self-center text-end pl-0 text-primary">
                <i data-feather="bar-chart-2" class="feather-icon  fa-dash"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <form action="" method="get" id="form">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Consumo mensal (kWh)
                <div class="pull-right-box">
                  <div class="input-group mb-3">
                    <input type="text" name="ymensal" value="<?= $ymensal ?>" id="ymensal" class="form-control" style="width:90px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-calendar me-1 text-sucess"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </h4>
              <div id="chart"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Consumo diário (kWh)
                <div class="pull-right-box">
                  <div class="input-group mb-3">
                    <input type="text" name="ydiario" value="<?= $ydiario ?>" id="ydiario" class="form-control" style="width:90px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-calendar me-1 text-sucess"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </h4>
              <div id="chartDiario"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Consumo horário (kWh)
                <div class="pull-right-box">
                  <div class="input-group mb-3">
                    <input type="text" name="chorario" value="<?= $chorario ?>" id="chorario" class="form-control" style="width:120px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-calendar me-1 text-sucess"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </h4>
              <div id="chartHorario"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Consumo diário acumulado (kWh)
                <div class="pull-right-box">
                  <div class="input-group mb-3">
                    <input type="text" name="ydiarioacumulado" value="<?= $ydiarioacumulado ?>" id="ydiarioacumulado" class="form-control" style="width:120px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-calendar me-1 text-sucess"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </h4>
              <div id="chartDiarioAcumulado"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Consumo horário acumulado (kWh)
                <div class="pull-right-box">
                  <div class="input-group mb-3">
                    <input type="text" name="chorarioAcu" value="<?= $chorarioAcu ?>" id="chorarioAcu" class="form-control" style="width:120px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-calendar me-1 text-sucess"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </h4>
              <div id="chartHorarioAcumulado"></div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>