<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */

class AppAsset extends AssetBundle
{   
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'libs/libs/apexcharts/dist/apexcharts.css',
        'libs/extra-libs/jvector/jquery-jvectormap-2.0.2.css',
        'libs/libs/fullcalendar/dist/fullcalendar.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css',
        'css/style.css',
    ];
    public $js = [
        'libs/extra-libs/taskboard/js/jquery.ui.touch-punch-improved.js',
        'libs/extra-libs/taskboard/js/jquery-ui.min.js',
        'libs/libs/bootstrap/dist/js/bootstrap.bundle.min.js',
        'js/app.min.js',
        'js/app.init.js',
        'js/app-style-switcher.js',
        'libs/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js',
        'js/waves.js',
        'js/sidebarmenu.js',
        'js/feather.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js',
        'js/custom.min.js',
        'js/functions.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
