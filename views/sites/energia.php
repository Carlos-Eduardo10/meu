<?php

/** @var yii\web\View $this */

use app\models\Sites;
use yii\web\View;

?>
<div class="page-wrapper">
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-md-8 align-self-center">
        <h3 class="page-title"><?= Sites::retornaNomeBusca() ?></h3>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Energia</a></li>
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
    <div class="col-md-2">
      <div class="card" style="min-height: 151px;">
        <div class="card-body">
          <div class="row">
            <div class="col-8">
              <?php if (isset($consumoEnergiaForaPontaDoReferidoMes['v_consumption_demand_active_out_peak_kw'])) : ?>
                <span style="font-size:20px; white-space: nowrap;" class="display-6">
                  <?= number_format($consumoEnergiaForaPontaDoReferidoMes['v_consumption_demand_active_out_peak_kw'], 1, ',', '.') ?> kW
                </span>
                <h6 style="font-size:11px; font-weight:bold;">Demanda fora ponta</h6>
                <p style="font-size:10px; color: #ccc;">
                  <?= $consumoEnergiaForaPontaDoReferidoMes['formatted_datetime'] ?>
                </p>
              <?php else : ?>
                <span style="font-size:20px; white-space: nowrap;" class="display-6">0 kW</span>
                <h6 style="font-size:11px; font-weight:bold;">Demanda fora ponta</h6>
              <?php endif; ?>
            </div>
            <div class="col-4 align-self-center text-end pl-0 text-muted">
              <i data-feather="bar-chart-2" class="feather-icon fa-dash"></i>
            </div>
            </div>
          </div>
        </div>
      </div>
<div class="col-md-2">
  <div class="card" style="min-height: 151px;">
    <div class="card-body">
      <div class="row">
        <div class="col-8">
          <?php if (isset($consumoEnergiaPontaDoReferidoMes['v_consumption_demand_active_peak_kw'])) : ?>
            <span style="font-size: 20px; white-space: nowrap;" class="display-6">
              <?= number_format($consumoEnergiaPontaDoReferidoMes['v_consumption_demand_active_peak_kw'], 1, ',', '.') ?> kW
            </span>
            <h6 style="font-size: 12px; font-weight: bold;">Demanda ponta</h6>
            <p style="font-size: 10px; color: #ccc;">
              <?= $consumoEnergiaPontaDoReferidoMes['formatted_datetime'] ?>
            </p>
          <?php else : ?>
            <span style="font-size: 20px; white-space: nowrap;" class="display-6">0 kW</span>
            <h6 style="font-size: 11px; font-weight: bold;">Demanda ponta</h6>
          <?php endif; ?>
        </div>
        <div class="col-4 align-self-center text-end pl-0 text-muted">
          <i data-feather="bar-chart-2" class="feather-icon fa-dash"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-2">
  <div class="card" style="min-height: 151px;">
    <div class="card-body">
      <div class="row">
        <div class="col-8">
          <?php if (isset($ultimaLeituraConsumoEnergia['v_consumption_demand_active_kw'])) : ?>
            <span style="font-size: 20px; white-space: nowrap;" class="display-6">
              <?= number_format($ultimaLeituraConsumoEnergia['v_consumption_demand_active_kw'], 1, ',', '.') ?> kW
            </span>
            <h6 style="font-size: 12px; font-weight: bold;">Última leitura</h6>
            <p style="font-size: 10px; color: #ccc;">
              <?= $ultimaLeituraConsumoEnergia['formatted_datetime'] ?>
            </p>
          <?php else : ?>
            <span style="font-size: 20px; white-space: nowrap;" class="display-6">0 kW</span>
            <h6 style="font-size: 11px; font-weight: bold;">Última leitura</h6>
          <?php endif; ?>
        </div>
        <div class="col-4 align-self-center text-end pl-0 text-primary">
        <i data-feather="bar-chart-2" class="feather-icon fa-dash" style="color: #90a4ae;"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="card" style="min-height: 151px;">
    <div class="card-body">
      <div class="row">
        <div class="col-8">
          <span style="font-size:20px; white-space: nowrap;" class="display-6">
            <?= number_format($consumoTotalEnergiaDoReferidoMes['total_energy'], 0, ',', '.') ?> kWh
          </span>
          <h6 style="font-size:12px; font-weight:bold;">Consumo total</h6>
          <p style="font-size:10px; color: #ccc;">
            <?php echo (!empty($consumoTotalEnergiaDoReferidoMes['min_date']) ? $consumoTotalEnergiaDoReferidoMes['min_date'] . " até " . $consumoTotalEnergiaDoReferidoMes['max_date'] : 0); ?>
          </p>
        </div>
        <div class="col-4 align-self-center text-end pl-0 text-primary">
        <i data-feather="bar-chart-2" class="feather-icon fa-dash" style="color: #90a4ae;"></i>
        </div>
      </div>
    </div>
  </div>
</div>
      <div class="col-md-3">
  <div class="card" style="min-height: 151px;">
    <div class="card-body">
      <div class="row">
        <div class="col-8">
          <span style="font-size:22px; white-space: nowrap;" class="display-6">
            <?= number_format($ultimofatorDePotencia['v_consumption_power_factor'], 3, ',', '.') ?>
          </span>
          <h6 style="font-size:12px; font-weight:bold;">Fator de potência</h6>
          <p style="font-size:10px; color: #ccc;">
            <?= $ultimofatorDePotencia['formatted_datetime'] ?>
          </p>
        </div>
        <div class="col-4 align-self-center text-end pl-0 text-primary">
        <i data-feather="bar-chart-2" class="feather-icon fa-dash" style="color: #90a4ae;"></i>
        </div>
      </div>
    </div>
  </div>
</div>
    </div>
    <form action="" method="get" id="form">
      <div class="row">
        <div class="col-md-7">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title fw-bold">Perfil de carga
                <div class="pull-right-box">
                  <div class="input-group mb-3">
                  <input type="text" name="chorario" value="<?= date("d-m-Y") ?>" id="ygraphPerfilCarga" class="form-control" style="width:120px;">
                  <input type="hidden" id="site_type" name="site_type" value="<?= Sites::retornaSiteType() ?>">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-calendar me-1 text-sucess"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </h4>
              <div id="graphPerfilCarga"></div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Demandas máximas
                <div class="pull-right-box">
                  <div class="input-group mb-3">
                    <input type="text" name="ydiario" value="<?= date("m-Y") ?>" id="ygraphDemandaMaxima" class="form-control" style="width:120px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-calendar me-1 text-sucess"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </h4>
              <div id="graphDemandaMaxima"></div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title fw-bold">Consumo
                <div class="pull-right-box">
                  <div class="input-group mb-3">
                  <input type="hidden" id="site_type" name="site_type" value="<?= Sites::retornaSiteType() ?>">
                    <input type="text" name="ygraphEnergiaConsumo" value="<?= date("m-Y") ?>" id="ygraphEnergiaConsumo" class="form-control" style="width:90px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-calendar me-1 text-sucess"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </h4>
              <div id="graphEnergiaConsumo"></div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card" style="height: 475px;">
            <div class="card-body">
              <div class="d-md-flex align-items-center">
                <h4 class="card-title fw-bold">Consumo por posto tarifário</h4>
                <div class="pull-right-box">
                  <div class="input-group mb-3">
                    <input type="text" name="ygraphConsumoPostoTarifado" value="<?= date("m-Y") ?>" id="ygraphConsumoPostoTarifado" class="form-control" style="width:90px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-calendar me-1 text-sucess"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div id="graphEnergiaConsumoPostoTarifado"></div>
                </div>
                <div class="col-md-6 overflow-auto" style="font-size:14px;">
                  <table id="pie" class="table table-sm">
                    <thead>
                      <tr>
                        <th style="font-weight: 500;">Posto</th>
                        <th style="font-weight: 500;">kWh</th>
                        <th style="font-weight: 500;">%</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Ponta</td>
                        <td>0</td>
                        <td>0</td>
                      </tr>
                      <tr>
                        <td>Fora Ponta</td>
                        <td>0</td>
                        <td>0</td>
                      </tr>
                      <tr>
                        <td>Total</td>
                        <td>0</td>
                        <td>0</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <div class="d-md-flex align-items-center">
                <h4 class="card-title">Fator de potência</h4>
                <div class="ms-auto">
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <h6 class="text-muted">
                        <div class="input-group mb-3">
                          
                          <div class="input-group-prepend">

                          </div>
                        </div>
                      </h6>
                    </li>
                  </ul>
                </div>
              </div>
              <div id="chart5e"></div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Última fatura importada
                <div class="pull-right-box">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">

                    </div>
                  </div>
                </div>
              </h4>
              <h4>Nenhuma fatura encontrada</h4>
            </div>
          </div>
        </div>


        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <div class="d-md-flex align-items-center">
                <h4 class="card-title">Histórico de faturas</h4>
                <div class="ms-auto">
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <h6 class="text-muted">
                        <div class="input-group mb-3">
                          <input type="hidden" id="dt_year_validate" />
                          <input class="form-control" style="width:90px;" id="dt_year" name="dt_year" onkeypress="$(this).mask('0000')" onchange="javascript:getConsumptionYear();" value="2023">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">&nbsp;
                              <i class="fa fa-calendar me-1 text-sucess">&nbsp;</i>
                            </span>
                          </div>
                        </div>
                      </h6>
                    </li>
                  </ul>
                </div>
              </div>
              <div id="chart1e"></div>
            </div>
          </div>
        </div>


        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Divisão de custos da última fatura
                <div class="pull-right-box">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">

                    </div>
                  </div>
                </div>
              </h4>
              <h4>Nenhuma fatura encontrada</h4>
            </div>
          </div>
        </div> -->

      </div>
    </form>
  </div>
</div>
<style>
  @media screen and (min-width: 1460px) {
    #pie {
      margin-left: 0px;
    }
  }

  @media screen and (min-width: 1000px) and (max-width: 1340px) {
    #pie {
      margin-left: -35px;
    }
  }

  @media screen and (min-width: 1340px) and (max-width: 1460px) {
    #pie {
      margin-left: -25px;
    }
  }

  @media screen and (min-width: 1000px) {
    #graphEnergiaConsumoPostoTarifado {
      margin-left: -72px;
    }
  }
</style>

<?php
$this->registerJsFile('@web/js/graphs-energia.js', ['position' => View::POS_END, 'depends' => 'yii\web\JqueryAsset']);
