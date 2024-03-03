<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'pt_BR',
    'timezone' => 'America/Sao_Paulo',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '9GvNOx1VtDhPJPyw-U8QGcnBDGOH5BYB',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'css' => [],
                ],
            ],
        ],
        
        // Adicione a configuração abaixo fora da chave 'bundles'
        'assetManager' => [
            'bundles' => [
                'yii\jui\DatePickerAsset' => [
                    'depends' => 'yii\web\JqueryAsset',
                ],
            ],
        ],
            
            // 'mailer' => [
            //     'class' => 'yii\swiftmailer\Mailer',
            //     'transport' => [
            //         'class' => 'Swift_SmtpTransport',
            //         'host' => 'sandbox.smtp.mailtrap.io',
            //         'username' => 'a04a6b816fc34c',
            //         'password' => '6f98ccb05be2e0',
            //         'port' => '2525',
            //         'encryption' => 'tls',
            //     ],
            // ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'email-ssl.com.br',                
                'username' => 'robogreen@wenergy.com.br',
                'password' => 'W@energy#9080',              
                'port' => '465',               
                'encryption' => 'ssl',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'sites/powerbi' => 'sites/powerbi', // Nova regra para a ação 'PowerBi' do controlador 'SitesController'
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
