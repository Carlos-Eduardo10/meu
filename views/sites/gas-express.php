<?php

/** @var yii\web\View $this */

use app\models\Sites;
use yii\web\View;

// Obtenha o número do mês atual
$currentMonth = date('n') - 1; // Os meses no PHP começam em 1, mas os índices de array em PHP começam em 0

$consumoMes = ($consumoDoMes['consume'] > 0) ? $consumoDoMes['consume'] : 1;
$currentMonthlyValue = (isset($media['monthlyValues'][$currentMonth])) ? $media['monthlyValues'][$currentMonth] : 1;
$currentBaselineValue = (isset($media['monthlyBaselineValues'][$currentMonth])) ? $media['monthlyBaselineValues'][$currentMonth] : 1;

if (Yii::$app->session->get('search_tipo') != 'site') {
  $return_consumption = Sites::selectConsumptionMonth();
  $return = Sites::selectBaseLine();

  //Instanciando arrays e variáveis
  $array_baseline = array_fill(0, 12, 0);
  $array_count_month = array_fill(0, 12, 0);
  $total_consumption = 0;
  $total_baseline = 0;

  //Varrendo o resultado de baseline e adicionando no array
  foreach ($return as $baseline) {
    $array = $baseline["config_value"];
    for ($i = 0; $i < sizeof($array); $i++) {
      $array_baseline[$i] = floatval($array_baseline[$i]) + floatval($array[$i]);
    }
  }

  //Varrendo resultado de consumo, vindo do databse, e armazenando em array de quantidade de meses
  foreach ($return_consumption as $count_month) {
    //Código para evitar que se contabilizem meses que tenham consumo 0 (ZERO)
    if (floatval($count_month["consumption_value"]) > 0) {
      $array_count_month[intval($count_month["month_number"]) - 1] = intval($array_count_month[intval($count_month["month_number"]) - 1]) + 1;
      $total_consumption = floatval($total_consumption) + floatval($count_month["consumption_value"]);
    }
  }

  //Varrendo array de quantidade de meses, multiplicando cada quantidade de mês x valor da baseline e armazenando na viarável
  for ($i = 0; $i < sizeof($array_count_month); $i++) {
    $total_baseline = floatval($total_baseline) + ($array_count_month[$i] * $array_baseline[$i]);
  }
  if ($total_baseline == 0) {
    $mmes2 = 0;
  } else {

    $mmes2 = round(100 - (($total_consumption /  $total_baseline) * 100), 2);
  }
} else {
  $mmes2 = 0;
}


$pmes = round(($consumoMes * 100) /  $currentMonthlyValue, 2);
$mmes = round(($consumoMes * 100) /  $currentBaselineValue, 2);

$ymensal = (Yii::$app->request->get('ymensal') && Yii::$app->request->get('ymensal') > 0)
  ? Yii::$app->request->get('ymensal')
  : date("Y");

$ydiario = (Yii::$app->request->get('ydiario') && Yii::$app->request->get('ydiario') > 0)
  ? Yii::$app->request->get('ydiario')
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
              <li class="breadcrumb-item"><a href="#">Gás</a></li>
              <li class="breadcrumb-item active" aria-current="page">
                Express
              </li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="col-md-4 justify-content-end align-self-center d-none d-md-flex">
        <div class="d-flex">
          <div class="dropdown me-2 mr-4"> Dashboard Express
            <button class="btn btn-success dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
              Express
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" data-popper-placement="bottom-end">
              <li><a class="dropdown-item" href="/sites/gas">Principal</a></li>
            </ul>
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
                    <i class="ti-angle-<?= ($consumoDoDia['consume'] <= $consumoDoDia['average']) ? 'down' : 'up' ?> fs-3 text-<?= ($consumoDoDia['consume'] <= $consumoDoDia['average']) ? 'success' : 'danger' ?>">
                      <span style="font-family:Arial">
                          <?php $averageConsumption = 0;
                            if ($consumoDoMes['consume'] != 0 && $consumoDoDia['average'] != 0) {
                              $averageConsumption = round((($consumoDoDia['consume'] / $consumoDoDia['average']) * 100) - 100 , 2);
                            }
                            echo $averageConsumption * -1;
                          ?>%
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
                  <i class="ti-angle-down fs-3 text-success">
                      <span style="font-family:Arial">
                        100 %
                      </span>
                    </i>
                  </span>
                  <h6 style="font-size:12px; font-weight:bold;">Consumo total (dia)</h6>
                </div>
                <div class="col-4 align-self-center text-end pl-0 text-primary">
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
                    <i class="ti-angle-<?= ($consumoDoMes['consume'] <= $consumoDoMes['average']) ? 'down' : 'up' ?> fs-3 text-<?= ($consumoDoMes['consume'] <= $consumoDoMes['average']) ? 'success' : 'danger' ?>">
                      <span style="font-family:Arial">
                        <?php $averageConsumption = 0;
                        if ($consumoDoMes['consume'] != 0 && $consumoDoMes['average'] != 0) {
                          $averageConsumption = round((($consumoDoMes['consume'] / $consumoDoMes['average']) * 100) - 100 , 2);
                        }
                        echo $averageConsumption * -1;
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
                  <i class="ti-angle-down fs-3 text-success">
                      <span style="font-family:Arial">
                        100 %
                      </span>
                    </i>
                  </span>
                  <h6 style="font-size:12px; font-weight:bold;">Consumo total (mês)</h6>
                </div>
                <div class="col-4 align-self-center text-end pl-0 text-primary">
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
    <div class="row">
      <?php if (Yii::$app->session->get('search_tipo') == 'site') { ?>
        <div class="col-lg-12">
        <?php } else {  ?>
          <div class="col-md-8">
          <?php }  ?>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Consumo dinâmico (m3)</h4>
              <?= $this->render('graphs/_consumo_horario_dinamico', ['r' => 3]) ?>
            </div>
          </div>
          </div>
          <?php if (Yii::$app->session->get('search_tipo') != 'site') { ?>
            <div class="col-md-4">
              <div class="row">
                <div class="col-12">
                  <div class="card bg-<?= ($mmes > 100) ? 'danger' : 'success' ?>">
                    <div class="card-body">
                      <div class="d-flex">
                        <div class="me-3 align-self-center">
                          <h1 class="text-white">
                            <i class="icon-drop"></i>
                          </h1>
                        </div>
                        <div>
                          <h3 class="text-white">Economia</h3>
                          <h6 class="text-white">Estimada no período</h6>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-5 col-xl-7 align-self-center">
                          <h4 style="font-size: 30px;" class="dmmesisplay-7 text-white text-truncate">
                            <?= $mmes2 ?>%</h4>
                        </div>
                        <div class="col-7 col-xl-5 text-end">
                          <i style="height: 120px;" data-feather="bar-chart-2" class="feather-icon text-white fa-dash"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="card bg-<?= ($pmes > 100) ? 'danger' : 'primary' ?>">
                    <div class="card-body">
                      <div class="d-flex">
                        <div class="me-3 align-self-center">
                          <h1 class="text-white">
                            <i class="icon-graph"></i>
                          </h1>
                        </div>
                        <div>
                          <h3 class="text-white">Meta</h3>
                          <h6 class="text-white">Mês corrente: <?= date("m/Y") ?></h6>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-5 col-xl-7 align-self-center">
                          <h4 style="font-size: 28px;" class="display-7 text-white text-truncate">
                            <i data-feather="arrow-down" class="fill-white feather-sm"></i>
                            <?= 100 - $pmes ?>%
                          </h4>
                          <span style="font-size: 12px; color:#ffffff;">
                            <span style="background-color:#000000;">&nbsp;<?= ($pmes > 100) ? 'Fora do esperado' : 'Dentro do esperado' ?>&nbsp;</span>
                          </span>
                        </div>
                        <div class="col-7 col-xl-5 text-end">
                          <i style="height: 120px;" data-feather="bar-chart-2" class="feather-icon text-white fa-dash"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
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
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"> Visão geográfica das unidades </h4>
                    <?= $this->render('maps/_branchs') ?>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>

    <?php
    $this->registerJsFile('@web/js/graphs.js', ['position' => View::POS_END, 'depends' => 'yii\web\JqueryAsset']);