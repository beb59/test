<?php
$params = array_merge(
	require(__DIR__ . '/../../common/config/params.php'),
	#require(__DIR__ . '/../../common/config/params-local.php'),
	require(__DIR__ . '/params.php')
	#require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
	'defaultRoute' => 'main/index',
    'components' => [
		'request' => [
            'cookieValidationKey' => 'jkhkfjkh#EHJKjkh2jkjkl2jkjkl5!@',
        ],
        'user' => [
            'identityClass' => 'backend\models\Admin',
            'enableAutoLogin' => true,
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
		'urlManager' => [
			'class' => '\backend\components\CUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
			'rules' => array(
				#'ajax/<controller>' => 'ajax/admin',
				'ajax/<controller:\w+>/<action:\w+>/<id:\w+>' => 'ajax/<controller>/<action>',
				'ajax/<controller:\w+>/<action:\w+>' => 'ajax/<controller>/<action>',
				#'<controller:\w+>/<id:\w+>' => 'ajax/<controller>',
				#'<controller:\w+>/<action:\w+>/<id:\w+>' => 'ajax/<controller>/<action>',
				#'<controller:\w+>/<action:\w+>' => 'ajax/<controller>/<action>',
				'<controller>/<action>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
    ],
    'params' => $params,
];
