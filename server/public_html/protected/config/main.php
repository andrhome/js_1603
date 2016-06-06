<?php



// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Великий Вал',

    // preloading 'log' component
    'preload' => array(
        'debug',
		'log'
    ),
    //language for project
    'sourceLanguage'=>'uk',
    'language'=>'uk',

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),
    'modules'=>array(
        'admin',
        'blog',
        'vip',
		'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'123',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
    ),

    // application components
    'components'=>array(
        'debug' => array(
            'class' => 'ext.yii2-debug.Yii2Debug',
        ),
        'settings'=>array(
            'class'=>'application.components.Settings',
        ),
        'request'=>array(
            'enableCookieValidation'=>true,
            'enableCsrfValidation'=>false,
        ),
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>false,
            'loginUrl'=>array('admin/default/login'),
            'class' => 'WebUser',
        ),
        'authManager' => array(
            // Будем использовать свой менеджер авторизации
            'class' => 'PhpAuthManager',
            // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
            'defaultRoles' => array('guest'),
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'class'=>'application.components.UrlManager',
            'urlFormat'=>'path',
            'urlSuffix'=>'.html',
            'showScriptName'=>false,
            'rules'=>array(
                '<language:(ru|uk)>/' => 'site/index',
                '<language:(ru|uk)>/<id:\d+>' => 'site/news',
                '<category:\w+>/<id:\d+>'=>'site/news/',
                '<category:\w+>/<categorynew:\w+>/<id:\d+>'=>'site/news/',

                '<language:(ru|uk)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<language:(ru|uk)>/<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',

                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>/<language:(uk|ru)>'=>'<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<language:(uk|ru)>'=>'<module>/<controller>/<action>',
            ),
        ),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=val_val',
            'emulatePrepare' => true,
            'enableProfiling' => true,
            'enableParamLogging' => true,
            'username' => 'val',
            'password' => 'qwedsazxc123',
            'charset' => 'utf8',
			//'schemaCachingDuration' => 3600,
        ),
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),
		
        'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
            'driver'=>'GD',
        ),

        'clientScript' => array(
            'coreScriptPosition'=>CClientScript::POS_END,
            'packages'=>array(
                'jquery'=>array(
                    'js'=>array(YII_DEBUG ? 'jquery.js' : 'jquery.min.js'),
                ),
            )
        )
		
		
    ),
	
	

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        'languages'=>array('ru'=>'Русский', 'uk'=>'Українська'),
    ),
);