<?php
$params = array_merge(
	require __DIR__ . '/../../common/config/params.php',
	require __DIR__ . '/../../common/config/params-local.php',
	require __DIR__ . '/params.php',
	require __DIR__ . '/params-local.php'
);

return [
	'id' => 'app-backend',
	'name' => 'LCAPP',
	'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'backend\controllers',
	'bootstrap' => ['log'],
	'language' => 'en-US',
	'modules' => [
		'yii2images' => [
			'class' => 'rico\yii2images\Module',
			//be sure, that permissions ok
			//if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
			'imagesStorePath' => 'upload/all', //path to origin images
			'imagesCachePath' => 'upload/cache', //path to resized copies
			'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
			'placeHolderPath' => '@webroot/upload/all/no-image.png',
			// if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
			'imageCompressionQuality' => 100, // Optional. Default value is 85.
		],
	],
	'components' => [
		'request' => [
			'csrfParam' => '_csrf-backend',
			'baseUrl' => '/admin'
		],
		'user' => [
			'identityClass' => 'common\models\User',
			//'enableAutoLogin' => true,
			'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
		],
//        'session' => [
//            // this is the name of the session cookie used for login on the backend
//            'name' => 'advanced-backend',
//        ],
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
			'errorAction' => 'site/error',
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			//'suffix' => '.php',
			'rules' => [
				
				'hash-tag/view/<id:\d+>' => 'hash-tag/view',
				'hash-tag/update/<id:\d+>' => 'hash-tag/update',
				'hash-tag/<page:\d+>/' => 'hash-tag/index',
				'hash-tag/' => 'hash-tag/index',
				
				'collaboration/view/<id:\d+>' => 'collaboration/view',
				'collaboration/update/<id:\d+>' => 'collaboration/update',
				'collaboration/<page:\d+>/' => 'collaboration/index',
				'collaboration/' => 'collaboration/index',
				
				'collaboration-outcome/view/<id:\d+>' => 'collaboration-outcome/view',
				'collaboration-outcome/update/<id:\d+>' => 'collaboration-outcome/update',
				'collaboration-outcome/<page:\d+>/' => 'collaboration-outcome/index',
				'collaboration-outcome/' => 'collaboration-outcome/index',
				
				'settings/user/view/<id:\d+>' => 'user/view',
				'settings/user/update/<id:\d+>' => 'user/update',
				'settings/user/<page:\d+>/' => 'user/index',
				'settings/user/create' => 'user/create',
				'settings/user/' => 'user/index',
				
				'partner/view/<id:\d+>' => 'partner/view',
				'partner/update/<id:\d+>' => 'partner/update',
				'partner/<page:\d+>/' => 'partner/index',
				'partner/' => 'partner/index',
				
				'partner-rule/view/<id:\d+>' => 'partner-rule/view',
				'partner-rule/update/<id:\d+>' => 'partner-rule/update',
				'partner-rule/<page:\d+>/' => 'partner-rule/index',
				'partner-rule/' => 'partner-rule/index',
				
				'partner-rule-action/view/<id:\d+>' => 'partner-rule-action/view',
//				'partner-rule-action/update/<id:\d+>' => 'partner-rule-action/update',
				'partner-rule-action/<page:\d+>/' => 'partner-rule-action/index',
				'partner-rule-action/' => 'partner-rule-action/index',
				
//				'lovestar/view/<id:\d+>' => 'lovestar/view',
//				'lovestar/update/<id:\d+>' => 'lovestar/update',
				'lovestar/<page:\d+>/' => 'lovestar/index',
				'lovestar/' => 'lovestar/index',
				
				'lovestar-transaction/view/<id:\d+>' => 'lovestar-transaction/view',
				'lovestar-transaction/update/<id:\d+>' => 'lovestar-transaction/update',
				'lovestar-transaction/<page:\d+>/' => 'lovestar-transaction/index',
				'lovestar-transaction/' => 'lovestar-transaction/index',
				
				'admin/no-access' => '/admin/site/no-access',
				'<action>' => 'site/<action>',
			],
		],
		'assetManager' => [
			'basePath' => '@webroot/assets',
			'baseUrl' => '@web/assets',
			'appendTimestamp' => true,
		],
	],
	'params' => $params,
];
