<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@commentsImg' => '@app/web/comments-img',
        '@domain' => 'http://localhost/yii2adv',
    ],
    'language' => 'ru',
    'bootstrap' => ['custombootstrap'],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2adv',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@common/translations'
                ]
            ]

        ],
        'custombootstrap' => [
            'class' => \common\components\CustomBootstrap::class
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //'tasks' => 'task/index',
                //'task/<id:\d+>' => 'task/one',
                //'task/<id:\w+>' => 'task/two',
                //'GET task/<id>' => 'task/one',
                //'POST task/<id>' =>  'task/two',
            ],
        ],

    ],
];
