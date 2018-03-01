<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'params' => $params,
    'components' => [],
	'controllerMap' => [
		'migrate' => [
			'class' => 'yii\console\controllers\MigrateController',
			'templateFile' => '@app/migrations/Template.php',
		],
	],
];

if (YII_ENV_DEV) {
    $config = yii\helpers\BaseArrayHelper::merge(require(__DIR__.'/dev.php'), $config);
}

return yii\helpers\BaseArrayHelper::merge(require(__DIR__.'/common.php'), $config);

