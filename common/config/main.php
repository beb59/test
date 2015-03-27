<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'db'=>[
            'class'=>'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=test_blog',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'            
        ],
		'AuthClient' => [
			'class' => 'frontend\components\AuthClient',
			'clients' => [
				'google' => [
					'class' => 'yii\authclient\clients\GoogleOpenId'
				],
				'facebook' => [
					//'class' => 'yii\authclient\clients\Facebook',
					'link' => 'https://www.facebook.com/dialog/oauth',
					'clientId' => '783374415045579',
					'clientSecret' => '86e0a69efef24ca13b66668f47ff3214',
					'get_token_url' => 'https://graph.facebook.com/oauth/access_token',
					'get_user_info' => 'https://graph.facebook.com/me',
				],
				'vkontakte' => [
					// register your app here: https://vk.com/editapp?act=create&site=1
					'class' => '\frontend\components\OAuth\Vkontakte',
					'link' => 'http://oauth.vk.com/authorize',
					'get_token_url' => 'https://oauth.vk.com/access_token',
					'get_user_info' => 'https://api.vk.com/method/users.get',
					'clientId' => '4702474',
					'clientSecret' => 'JZL0dgt2vzsCdqjzDEFj',
				],
			],
		],
		'eauth' => [
            'class' => 'nodge\eauth\EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'httpClient' => [
                // uncomment this to use streams in safe_mode
                //'useStreamsFallback' => true,
            ],
            'services' => [ // You can change the providers and their classes.
                'google' => [
                    'class' => 'nodge\eauth\services\GoogleOpenIDService',
                    //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
                ],
                'yandex' => [
                    'class' => 'nodge\eauth\services\YandexOpenIDService',
                    //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
                ],
                'twitter' => [
                    // register your app here: https://dev.twitter.com/apps/new
                    'class' => 'nodge\eauth\services\TwitterOAuth1Service',
                    'key' => '...',
                    'secret' => '...',
                ],
                'google_oauth' => [
                    // register your app here: https://code.google.com/apis/console/
                    'class' => 'nodge\eauth\services\GoogleOAuth2Service',
                    'clientId' => '...',
                    'clientSecret' => '...',
                    'title' => 'Google (OAuth)',
                ],
                'yandex_oauth' => [
                    // register your app here: https://oauth.yandex.ru/client/my
                    'class' => 'nodge\eauth\services\YandexOAuth2Service',
                    'clientId' => '...',
                    'clientSecret' => '...',
                    'title' => 'Yandex (OAuth)',
                ],
                'facebook' => [
                    // register your app here: https://developers.facebook.com/apps/
                    'class' => 'nodge\eauth\services\FacebookOAuth2Service',
                    'clientId' => '...',
                    'clientSecret' => '...',
                ],
                'yahoo' => [
                    'class' => 'nodge\eauth\services\YahooOpenIDService',
                    //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
                ],
                'linkedin' => [
                    // register your app here: https://www.linkedin.com/secure/developer
                    'class' => 'nodge\eauth\services\LinkedinOAuth1Service',
                    'key' => '...',
                    'secret' => '...',
                    'title' => 'LinkedIn (OAuth1)',
                ],
                'linkedin_oauth2' => [
                    // register your app here: https://www.linkedin.com/secure/developer
                    'class' => 'nodge\eauth\services\LinkedinOAuth2Service',
                    'clientId' => '...',
                    'clientSecret' => '...',
                    'title' => 'LinkedIn (OAuth2)',
                ],
                'github' => [
                    // register your app here: https://github.com/settings/applications
                    'class' => 'nodge\eauth\services\GitHubOAuth2Service',
                    'clientId' => '...',
                    'clientSecret' => '...',
                ],
                'live' => [
                    // register your app here: https://account.live.com/developers/applications/index
                    'class' => 'nodge\eauth\services\LiveOAuth2Service',
                    'clientId' => '...',
                    'clientSecret' => '...',
                ],
                'steam' => [
                    'class' => 'nodge\eauth\services\SteamOpenIDService',
                    //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
                ],
                'vkontakte' => [
                    // register your app here: https://vk.com/editapp?act=create&site=1
                    'class' => 'nodge\eauth\services\VKontakteOAuth2Service',
                    'clientId' => '4702351',
                    'clientSecret' => '96rHsnRnwkgiOTzTz2my',
                ],
                'mailru' => [
                    // register your app here: http://api.mail.ru/sites/my/add
                    'class' => 'nodge\eauth\services\MailruOAuth2Service',
                    'clientId' => '...',
                    'clientSecret' => '...',
                ],
                'odnoklassniki' => [
                    // register your app here: http://dev.odnoklassniki.ru/wiki/pages/viewpage.action?pageId=13992188
                    // ... or here: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
                    'class' => 'nodge\eauth\services\OdnoklassnikiOAuth2Service',
                    'clientId' => '...',
                    'clientSecret' => '...',
                    'clientPublic' => '...',
                    'title' => 'Odnoklas.',
                ],
            ],
		],
    ],
];
