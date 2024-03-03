<?php

use app\models\Alarm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var app\models\search\Alarm $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Alarms';
?>
<head>
    <title>Jquery - Bootstrap Daterangepicker Example</title>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
</head>
<div class="page-wrapper">
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-md-5 align-self-center">
        <h3 class="page-title">Alarmes:</h3>
        <div class="d-flex align-items-center">

        </div>
      </div>
      <div class="
                col-md-7
                justify-content-end
                align-self-center
                d-none d-md-flex
              ">
        <div class="d-flex">
          <!--<button class="btn btn-success">
                  <i data-feather="plus" class="fill-white feather-sm"></i>
                  Create
                </button>-->
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid note-has-grid">
    <ul class="nav nav-pills p-3 bg-white mb-3 align-items-center">

      <li class="nav-item">
        <a href="/alarm" class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2 active" id="note-business">
          <i data-feather="bell" class="feather-sm fill-white me-0 me-md-1"></i>
          <span class="d-none d-md-block font-weight-medium ">Ocorrências</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="/alarm/criar" class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2" id="note-social">
          <i data-feather="sliders" class="feather-sm fill-white me-0 me-md-1"></i>
          <span class="d-none d-md-block font-weight-medium">Criar e configurar
          </span>
        </a>
      </li>
    </ul>

    <div class="tab-content">

      <div class="col-md-12 single-note-item all-category note-business">
        <div class="card">
          <div class="card-body">
            <div class="row mt-4">
              <!-- Column -->
              <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                  <div class="p-2 rounded bg-light-primary text-center">
                    <h1 class="fw-light text-primary"><?= $totalizador['total'] ?></h1>
                    <h6 class="text-primary">Total Alarmes</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                  <div class="p-2 rounded bg-light-danger text-center">
                    <h1 class="fw-light text-danger"><?= $totalizador['abertos'] ?></h1>
                    <h6 class="text-danger">Abertos</h6>
                  </div>
                </div>
              </div>
              <!-- Column -->
              <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                  <div class="p-2 rounded bg-light-success text-center">
                    <h1 class="fw-light text-success"><?= $totalizador['fechados'] ?></h1>
                    <h6 class="text-success">Finalizados</h6>
                  </div>
                </div>
              </div>
              <!-- Column -->
            </div>

            <div class="table-responsive mt-4">
              <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                  'alarmlog_id',
                  [
                    'attribute' => 'alarmlog_status',
                    'format' => 'raw',
                    'filter' => Html::activeDropDownList(
                      $searchModel,
                      'alarmlog_status',
                      [
                        1 => 'Em Ocorrência',
                        2 => 'Finalizado',
                      ],
                      ['class' => 'form-control', 'prompt' => 'Selecionar ...']
                    ),
                    'value' => function ($model) {
                      return $model->alarmlog_status === 2
                        ? Html::tag('span', 'Finalizado', ['class' => 'badge bg-success'])
                        : Html::tag('span', 'Em Ocorrência', ['class' => 'badge bg-danger']);
                    }
                  ],
                  'alarmlog_description',
                  [
                    'attribute' => 'Date',
                    'value' => function ($model) {
                        return date('d/m/Y H:i:s', strtotime($model->alarmlog_date));
                    },
                    'filter' => '<input type="text" class="daterange" style="height: 37px; border: 1px solid #ccc; border-radius: 5px;" />
                    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/locale/pt-br.js"></script>
                    <script type="text/javascript">
                        $(\'.daterange\').daterangepicker({
                            locale: {
                                format: \'DD/MM/YYYY\',
                                applyLabel: \'Aplicar\',
                                cancelLabel: \'Cancelar\',
                                daysOfWeek: [\'Dom\', \'Seg\', \'Ter\', \'Qua\', \'Qui\', \'Sex\', \'Sáb\'],
                                monthNames: [\'Janeiro\', \'Fevereiro\', \'Março\', \'Abril\', \'Maio\', \'Junho\', \'Julho\', \'Agosto\', \'Setembro\', \'Outubro\', \'Novembro\', \'Dezembro\'],
                                firstDay: 1
                            },
                            opens: \'left\', // ajuste conforme necessário
                            autoUpdateInput: false,
                            startDate: moment().startOf(\'day\'),
                            endDate: moment().endOf(\'day\'),
                        }, function(start, end, label) {
                            var formattedDate = start.format(\'DD/MM/YYYY\') + \' - \' + end.format(\'DD/MM/YYYY\');
                            $(\'.daterange\').val(formattedDate);
                        });
                    
                        $(\'.daterange\').on(\'apply.daterangepicker\', function(ev, picker) {
                            // Ao aplicar, atualize o valor do input e envie o formulário
                            var formattedDate = picker.startDate.format(\'DD/MM/YYYY\') + \' - \' + picker.endDate.format(\'DD/MM/YYYY\');
                            $(this).val(formattedDate);
                            $(this).closest(\'form\').submit();
                        });
                    </script>',
                ],
            ],
        ]); ?>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

