<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
//        'request' => [
//            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
//            'cookieValidationKey' => 'WWAH9LZfwzvV4R-1RoZybEHJTagZa7KT',
//        ],
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
//        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//        ],
//        'errorHandler' => [
//            'errorAction' => 'site/error',
//        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
];






