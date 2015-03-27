<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    #require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
    #require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
	'defaultRoute' => 'main/index',
    'components' => [
		'request' => [
            'cookieValidationKey' => 'jkhkfjkh#EHJKjkh2jkjkl2jkjkl5!@',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
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
        'errorHandler' => [
            'errorAction' => 'main/error',
        ],
		'i18n' => array(
            'translations' => array(
                'eauth' => array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@eauth/messages',
                ),
            ),
        ),
		'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
			'rules' => array(
				'post/<id:\w+>' => 'post/view',
				'category/<id:\w+>' => 'main/index',
				'<controller>/<action>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		],
    ],
    'params' => $params,
];
