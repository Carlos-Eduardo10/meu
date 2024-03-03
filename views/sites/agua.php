<?php

/** @var yii\web\View $this */

use app\models\Sites;
use yii\web\View;

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
              <li class="breadcrumb-item"><a href="#">Água</a></li>
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
            <?php if (\Yii::$app->session->get('search_tipo') != 'group') { ?>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" data-popper-placement="bottom-end">
                <li><a class="dropdown-item" href="/sites/agua-express">Express</a></li>
              </ul>
            <?php }  ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <?php if ($consumoDoDia['consume'] != 0) : ?>
              <div class="row">
                <div class="col-8">
                  <span style="font-size:22px;" class="display-6"><?= $consumoDoDia['consume'] ?> m3 <br>
                    <i class="ti-angle-<?= ($consumoDoDia['consume'] <= $consumoDoDia['average']) ? 'up' : 'down' ?> fs-3 text-<?= ($consumoDoDia['consume'] <= $consumoDoDia['average']) ? 'success' : 'danger' ?>">
                      <span style="font-family:Arial">
                        <?=
                        ($consumoDoDia['consume'] && $consumoDoDia['consume'] > 0)
                          ? round($consumoDoDia['average'] * 100 / $consumoDoDia['consume'], 2)
                          : 0; ?>%
                      </span>
                    </i>
                  </span>
                  <h6 style="font-size:12px; font-weight:bold;">Consumo total (dia)</h6>
                </div>
                <div class="col-4 align-self-center text-end pl-0 text-<?= ($consumoDoDia['consume'] <= $consumoDoDia['average']) ? 'primary' : 'danger' ?>">
                  <i data-feather="bar-chart-2" class="feather-icon  fa-dash"></i>
                </div>
              </div>
            <?php else : ?>
              <div class="row">
                <div class="col-8">
                  <span style="font-size:22px;" class="display-6">0 m3 <br></span>
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
      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <?php if ($consumoDoMes['consume'] != 0) : ?>
              <div class="row">
                <div class="col-8">
                  <span style="font-size:22px;" class="display-6"><?= $consumoDoMes['consume'] ?> m3 <br>
                    <i class="ti-angle-<?= ($consumoDoMes['consume'] <= $consumoDoMes['average']) ? 'up' : 'down' ?> fs-3 text-<?= ($consumoDoMes['consume'] <= $consumoDoMes['average']) ? 'success' : 'danger' ?>">
                      <span style="font-family:Arial">
                        <?php $averageConsumption = 0;
                        if ($consumoDoMes['consume'] != 0) {
                          $averageConsumption = round($consumoDoMes['average'] * 100 / $consumoDoMes['consume'], 2);
                        }
                        echo $averageConsumption;
                        ?>%</span>
                    </i>
                  </span>
                  <h6 style="font-size:12px; font-weight:bold;">Consumo total (mês)</h6>
                </div>
                <div class="col-4 align-self-center text-end pl-0 text-<?= ($consumoDoMes['consume'] <= $consumoDoMes['average']) ? 'primary' : 'danger' ?>">
                  <i data-feather="bar-chart-2" class="feather-icon  fa-dash"></i>
                </div>
              </div>
            <?php else : ?>
              <div class="row">
                <div class="col-8">
                  <span style="font-size:22px;" class="display-6">0 m3 <br></span>
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
      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-8">
                <span style="font-size:22px;" class="display-6"><?= $ultimaLeituraConsumo['lastConsume'] ?> m3 <br>
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
      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-8">
                <span style="font-size:22px;" class="display-6"><?= round(($ultimaLeituraConsumo['lastConsume'] * 1000) / 60, 2)   ?> L/m <br>
                </span>
                <h6 style="font-size:12px; font-weight:bold;">Última leitura vazão</h6>
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
              <h4 class="card-title">Consumo mensal (m3)
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
              <h4 class="card-title">Consumo diário (m3)
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
              <h4 class="card-title">Consumo horário (m3)
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
              <h4 class="card-title">Consumo diário acumulado (m3)
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
              <h4 class="card-title">Consumo horário acumulado (m3)
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

<?php
$this->registerJsFile('@web/js/graphs.js', ['position' => View::POS_END, 'depends' => 'yii\web\JqueryAsset']);
