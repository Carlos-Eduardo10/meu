<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\models\ClientUser;
use app\models\Dashboard;
use app\models\Sites;

use kartik\growl\Growl;

if (Yii::$app->session->hasFlash('success')) :
  echo Growl::widget([
    'type' => Growl::TYPE_SUCCESS,
    'showSeparator' => true,
    'body' => Yii::$app->session->getFlash('success')
  ]);
endif;

if (Yii::$app->session->hasFlash('error')) :
  echo Growl::widget([
    'type' => Growl::TYPE_DANGER,
    'showSeparator' => true,
    'body' => Yii::$app->session->getFlash('error')
  ]);
endif;

$clientUrl = ClientUser::getClientUrl();

$resource = Dashboard::userSiteResource();

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('/images/favicon.png')]);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
  <title>W-energy - Solução em Telemetria</title>
  <?php $this->head() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords" content="w-energy, wenergy, telemetria, gestão em telemetria, eficiência energética, soluções em água, telemetria gás, telemetria água, eficiência hídrica " />
  <meta name="description" content="O W-energy é um software de telemetria. Uma solução para eficiência na gestão de recursos energéticos  e hídricos." />
  <meta name="robots" content="noindex,nofollow" />
  <link rel="canonical" href="https://www.wenergy.com.br" />
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-5MXY9C1SQY"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-5MXY9C1SQY');
  </script>
  <!-- Google tag (gtag.js) -->
</head>

<script type='text/javascript'>
  window.smartlook||(function(d) {
    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
    c.charset='utf-8';c.src='https://web-sdk.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', 'f6df7d475e82f27b4bc70a7b28fb69f2fbd3bb54', { region: 'eu' });
</script>



<?php $this->beginBody() ?>

<body>
<div class="preloader" id="loading">
    <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z" stroke="#009efb" stroke-width="2"></path>
      <path d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34" stroke="#009efb" stroke-width="2"></path>
      <path id="teabag" fill="#009efb" fill-rule="evenodd" clip-rule="evenodd" d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"></path>
      <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#009efb"></path>
      <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#009efb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
  </div>
  <div id="search-loading" class="preloader" style="display: none;">
    <!-- Coloque aqui o seu ícone ou mensagem de carregamento -->
    Carregando...
</div>

  <div id="main-wrapper">
    <header class="topbar">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
          <!-- This is for the sidebar toggle which is visible on mobile only -->
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <a class="navbar-brand" href="#">
            <!-- Logo icon -->
            <b class="logo-icon">
              <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
              <!-- Dark Logo icon -->
              <img src="/images/icone-w.png" width="32px" height="30px" alt="homepage" class="dark-logo" />
              <!-- Light Logo icon -->
              <img src="/images/icone-w-write.png" width="32px" height="30px" alt="homepage" class="light-logo" />
            </b>
            <!--End Logo icon -->
            <!-- Logo text -->
            <span class="logo-text">
              <!-- dark Logo text -->
              <img src="/images/logo-w.png" width="120px" height="30px" alt="homepage" class="dark-logo" />
              <!-- Light Logo text -->
              <img src="/images/logo-w-write.png" width="120px" height="30px" class="light-logo" alt="homepage" />
            </span>
          </a>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Toggle which is visible on mobile only -->
          <!-- ============================================================== -->
          <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto">
            <li class="nav-item d-none d-md-block">
              <a id="toggle-logo" class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i data-feather="arrow-left-circle" class="feather-sm"></i></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i data-feather="bell" class="feather-sm"></i>
                <div class="notify" style="display: none;">
                  <span class="heartbit"></span> <span class="point"></span>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-start mailbox dropdown-menu-animate-up">
                <ul class="list-style-none">
                  <li>
                    <div class="border-bottom rounded-top py-3 px-4">
                      <div class="mb-0 font-weight-medium fs-4">
                        Alarmes <span id='total'></span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="message-center notifications position-relative" style="height: 230px">

                    </div>
                  </li>
                  <li>
                    <a class="nav-link border-top text-center text-dark pt-3" href="/alarm">
                      <strong>Verificar todos os alarmes</strong>
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a href=""></a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item search-box d-block d-md-flex align-items-center">
              <div class="nav-link">
                <form class="app-search">
                  <input value="<?= (Sites::retornaNomeBuscaCampo()) ? Sites::retornaNomeBuscaCampo() : '' ?>" id="full_search" name="full_search" type="text" class="form-control rounded-pill border-0" placeholder="Pesquisar ponto/site..." />
                  <!-- <a class="srh-btn"><i data-feather="search" class="feather-sm fill-white mt-n1"></i></a> -->
                </form>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="<?= $clientUrl ?>" alt="user" width="30" class="profile-pic rounded-circle" onerror="this.src =  '/images/users/logo-wenergy.png'" />
              </a>
              <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                <div class="d-flex no-block align-items-center p-3 bg-info text-white mb-2">
                  <div class="">
                    <img src="<?= $clientUrl ?>" alt="user" class="rounded-circle" width="60" onerror="this.src =  '/images/users/logo-wenergy.png'" />
                  </div>
                  <div class="ms-2">
                    <h4 class="mb-0 text-white"><?= Yii::$app->user->identity->user_name ?></h4>
                    <p class="mb-0"><?= Yii::$app->user->identity->user_email ?></p>
                  </div>
                </div>
                <!--<a class="dropdown-item" href="#"><i data-feather="user" class="feather-sm text-info me-1 ms-1"></i>
                  Meu perfil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"><i data-feather="settings" class="feather-sm text-warning me-1 ms-1"></i>
                  Configurações</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i data-feather="mail" class="feather-sm text-danger me-1 ms-1"></i>
                  Mensagens</a>
                <div class="dropdown-divider"></div>-->
                <div class="pl-4 p-2">
                  <a href="/site/logout" data-method="post" class="btn d-block w-100 btn-info rounded-pill">Sair</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="left-sidebar">
      <div class="scroll-sidebar">
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="mdi mdi-dots-horizontal"></i>
              <span class="hide-menu"></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i data-feather="pie-chart" class="feather-icon"></i><span class="hide-menu">Dashboards
                  <!--<span class="badge badge-pill bg-success">1</span></span>--></a>
              <ul aria-expanded="false" class="collapse first-level">
                <?php if (in_array(1, $resource)) { ?>
                  <li class="sidebar-item">
                    <a href="/sites/agua-redirect" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Água </span></a>
                  </li>
                <?php } ?>
                <?php if (in_array(2, $resource)) { ?>
                  <li class="sidebar-item">
                    <a href="/sites/energia-redirect" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Energia </span></a>
                  </li>
                <?php } ?>
                <?php if (in_array(3, $resource)) { ?>
                  <li class="sidebar-item">
                    <a href="/sites/gas-redirect" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Gás </span></a>
                  </li>
                <?php } ?>
                <?php if (in_array(4, $resource)) { ?>
                  <li class="sidebar-item">
                    <a href="/sites/diesel-redirect" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Diesel </span></a>
                  </li>
                <?php } ?>
                <?php if (in_array(5, $resource)) { ?>
                  <li class="sidebar-item">
                    <a href="/sites/energia2-redirect" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Energia2 </span></a>
                  </li>
                <?php } ?>
              </ul>
            </li>
            <li class="nav-devider" style="margin-bottom:5px;margin-top:5px"></li>
            <li class="sidebar-item">
              <a class="sidebar-link  waves-effect waves-dark" href="/sites" aria-expanded="false"><i data-feather="map-pin" class="feather-icon"></i><span class="hide-menu">Sites/Grupos</span></a>
            </li>
            <?php
                // Obtém o ID do cliente atual usando o modelo ClientUser
            $clientId = app\models\ClientUser::getClientId();

               // Verifica se o cliente atual é o Cliente 4
            $isClient4 = $clientId == 4;

              // Se for o Cliente 4, renderiza a seção de relatórios
            if ($isClient4) {
            echo '<li class="nav-devider" style="margin-bottom:5px;margin-top:5px"></li>';
            echo '<li class="sidebar-item">';
            echo '<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">';
            echo '<i data-feather="bar-chart-2" class="feather-icon"></i><span class="hide-menu">Relatórios </span></a>';
            echo '<ul aria-expanded="false" class="collapse first-level">';
            echo '<li class="sidebar-item">';
            echo '<a href="/sites/power-bi" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> PowerBI Santander </span></a>';
            echo '</li></ul></li>';
            }
            ?>
            <li class="nav-devider" style="margin-bottom:5px;margin-top:5px"></li>
            <li class="sidebar-item">
              <a class="sidebar-link  waves-effect waves-dark" href="/sites/export" aria-expanded="false"><i data-feather="download" class="feather-icon"></i><span class="hide-menu">Exportação de dados</span></a>
            </li>
            <li class="nav-devider" style="margin-bottom:5px;margin-top:5px"></li>
            <li class="sidebar-item">
              <a class="sidebar-link  waves-effect waves-dark" href="/alarm" aria-expanded="false"><i data-feather="bell" class="feather-icon"></i><span class="hide-menu">Alarmes</span></a>
            </li>
            <li class="nav-devider" style="margin-bottom:5px;margin-top:5px"></li>
            <li class="sidebar-item">
              <a class="sidebar-link  waves-effect waves-dark" href="/site/logout" data-method="post" aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span class="hide-menu">Sair</span></a>
            </li>
            <li class="nav-devider" style="margin-bottom:5px;margin-top:5px"></li>
          </ul>
        </nav>
      </div>
    </aside>
    <?= $content ?>
    <footer class="footer text-center">
      <a href="https://www.wenergy.com.br/" target="_blank">
        Todos os direitos reservados - W-Energy Soluções em Energia e Água.
      </a>
    </footer>

  </div>
  <?php

  $this->registerJs("$(function() {
      $('#full_search').autocomplete({
        source: '/sites/search', // Endpoint do seu script PHP
        select: function(event, ui) {
          window.location.href = ui.item.url;
        },
        focus: function(event, ui) {
          $('#full_search').val(ui.item.value);
          return false;
        },
        minLength: 2
      }).autocomplete('instance')._renderItem = function(ul, item) {
        return $('<li>')
          .append(\"<div>\"  + item.value +  \"</div>\")
          .appendTo(ul);
      };
    });");
  ?>

  <?php $this->registerJs("$(function() {
    // Função para atualizar alarmes
    function updateAlarms() {
        $.ajax({
            url: '/alarm/get-alarms',  // Atualize com o caminho correto para a ação
            method: 'GET',
            dataType: 'json',
            success: function(data) {

                // Limpe as notificações existentes
                $('.message-center.notifications').empty();

                // Verifique se existem novos alarmes
                if (data.length > 0) {
                  $('.notify').css('display', '');
                } else {
                    $('.notify').css('display', 'none');
                }

                // Adicione novos alarmes à lista
                for (var i = 0; i < data.length; i++) {
                    var alarm = data[i];
                    $('.message-center.notifications').append(`
                        <a href=\"javascript:void(0)\" class=\"message-item d-flex align-items-center border-bottom px-3 py-2\">
                        <span class=\"btn btn-light-danger text-danger btn-circle\">
                          <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-flag feather-sm fill-white\"><path d=\"M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z\"></path><line x1=\"4\" y1=\"22\" x2=\"4\" y2=\"15\"></line></svg>
                        </span>    
                        <div class=\"w-75 d-inline-block v-middle ps-3\">
                                <span class=\"fs-2  fw-normal text-muted mt-1\">` + alarm.alarmlog_description + `</span>
                            </div>
                        </a>
                    `);
                }
            }
        });
    }

    // Atualize alarmes imediatamente ao carregar a página
    updateAlarms();

    // Atualize alarmes a cada 10 segundos
    setInterval(updateAlarms, 10000);
});
");
  ?>
<?php $this->registerJs("
    $(document).ready(function() {
        // Oculta o preloader inicialmente
        $('#loading').hide();

        // Adiciona um evento de clique ao link do Dashboard-Água
        $('a[href=\"/sites/agua-redirect\"]').click(function(event) {
            // Previne o comportamento padrão do link
            event.preventDefault();

            // Exibe o preloader
            $('#loading').show();

            // Redireciona para o link após um pequeno atraso (pode ajustar o tempo conforme necessário)
            setTimeout(function() {
                window.location.href = '/sites/agua-redirect';
            }, 500);
        });

        // Adiciona um evento de clique ao link do Dashboard-Energia
        $('a[href=\"/sites/energia-redirect\"]').click(function(event) {
            // Previne o comportamento padrão do link
            event.preventDefault();

            // Exibe o preloader
            $('#loading').show();

            // Redireciona para o link após um pequeno atraso (pode ajustar o tempo conforme necessário)
            setTimeout(function() {
                window.location.href = '/sites/energia-redirect';
            }, 500);
        });

        // Adiciona um evento de clique ao link do Dashboard-Gás
        $('a[href=\"/sites/gas-redirect\"]').click(function(event) {
            // Previne o comportamento padrão do link
            event.preventDefault();

            // Exibe o preloader
            $('#loading').show();

            // Redireciona para o link após um pequeno atraso (pode ajustar o tempo conforme necessário)
            setTimeout(function() {
                window.location.href = '/sites/gas-redirect';
            }, 500);
        });

        // Adiciona um evento de clique ao link do Dashboard-Diesel
        $('a[href=\"/sites/diesel-redirect\"]').click(function(event) {
            // Previne o comportamento padrão do link
            event.preventDefault();

            // Exibe o preloader
            $('#loading').show();

            // Redireciona para o link após um pequeno atraso (pode ajustar o tempo conforme necessário)
            setTimeout(function() {
                window.location.href = '/sites/diesel-redirect';
            }, 500);
        });
        
        // Adiciona um evento de seleção ao Autocomplete
        $('#full_search').on('autocompleteselect', function(event, ui) {
            // Exibe o preloader
            $('#loading').show();
    
            // Redireciona para o link após um pequeno atraso (pode ajustar o tempo conforme necessário)
            setTimeout(function() {
                window.location.href = ui.item.url;
            }, 500);
        });

        // Adiciona um evento de clique aos links de relatórios na GridView
        $('.grid-view').on('click', 'a[data-url]', function(event) {
            // Previne o comportamento padrão do link
            event.preventDefault();
    
            // Exibe o preloader
            $('#loading').show();
    
            var reportUrl = $(this).data('url');
    
            // Redireciona para o link após um pequeno atraso (500ms)
            setTimeout(function() {
                window.location.href = reportUrl;
            }, 500);
        });
    
    });

    
"); ?>




  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>