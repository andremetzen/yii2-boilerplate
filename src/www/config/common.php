<?php
if (!function_exists('dump')) {

    function dump($data, $depth = 10)
    {
        if (YII_DEBUG)
            yii\helpers\VarDumper::dump($data, $depth,
                !(Yii::$app instanceof yii\console\Application) && !defined('YII_TEST')
                && (Yii::$app->request && (!Yii::$app->request->isAjax)));
    }
}


return [
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'db' => require(__DIR__ . '/db.php'),

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'mutex'=> [
            'class' => 'yii\mutex\MysqlMutex',
        ],
        'service' => [
            'class' => 'conceptho\ServiceLayer\Component',
        ],
    ]
];