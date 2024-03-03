<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;

use kartik\growl\Growl;

if (Yii::$app->session->hasFlash('success')):
  echo Growl::widget([
    'type' => Growl::TYPE_SUCCESS,
    'showSeparator' => true,
    'body' => Yii::$app->session->getFlash('success')
  ]);
endif; 

if (Yii::$app->session->hasFlash('error')):
  echo Growl::widget([
    'type' => Growl::TYPE_DANGER,
    'showSeparator' => true,
    'body' => Yii::$app->session->getFlash('error')
  ]);
endif; 


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
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5MXY9C1SQY"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-5MXY9C1SQY');
  </script>
   <!-- Google tag (gtag.js) -->
   <script type='text/javascript'>
  window.smartlook||(function(d) {
    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
    c.charset='utf-8';c.src='https://web-sdk.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', 'f6df7d475e82f27b4bc70a7b28fb69f2fbd3bb54', { region: 'eu' });
</script>
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z" stroke="#009efb" stroke-width="2"></path>
                <path d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34" stroke="#009efb" stroke-width="2"></path>
                <path id="teabag" fill="#009efb" fill-rule="evenodd" clip-rule="evenodd" d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"></path>
                <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#009efb"></path>
                <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#009efb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
        <?= $content ?>
    </div>



    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>