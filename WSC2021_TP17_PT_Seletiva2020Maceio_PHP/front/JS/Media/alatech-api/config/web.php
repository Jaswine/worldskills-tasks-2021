<?php

use app\bootstrap\CorsBootstrap;
use app\models\authorization\User;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\rest\UrlRule;
use yii\web\JsonParser;
use yii\web\JsonResponseFormatter;
use yii\web\Request;
use yii\web\Response;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'xx_alatech',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'contentNegotiator',
        'cors',
        //CorsBootstrap::class,
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'en',
    'components' => [
        'cors' => [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => null,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' => [],
            ]
        ],
        'contentNegotiator' => [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
            'languages' => [
                'en-US',
            ],
        ],
        'request' => [
            'class' => Request::class,
            'cookieValidationKey' => 'wFeScriKqPo9x92KRgkrpxSCjVlYffwZ',
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
            'acceptableContentTypes' => [
                'application/json' => 1
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => User::class,
            // Regular Session Authorization
//            'enableAutoLogin' => true,
//            'enableSession' => true
            // Token-based Authorization
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => 'api/v1/authorization/login',
        ],
        'response' => [
            'class' => Response::class,
            'format' => Response::FORMAT_JSON,
            'formatters' => [
                Response::FORMAT_JSON => [
                    'class' => JsonResponseFormatter::class,
                ],
            ],
            'charset' => 'UTF-8',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
                [
                    'class' => UrlRule::class,
                    'controller' => 'alatech/api/login'
                ],
                [
                    'class' => UrlRule::class,
                    'controller' => 'alatech/api/logout'
                ],
                [
                    'class' => UrlRule::class,
                    'controller' => 'alatech/api/machines',
                ],
                'alatech/api/images/<id>' => 'alatech/api/images/index',
                'alatech/api/search/<category>' => 'alatech/api/search/index'
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
