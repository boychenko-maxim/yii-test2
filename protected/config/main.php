<?php

// This is the main Web application configuration. Any writable
// application properties can be configured here.
return array(
    'defaultController'=>'site',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Библиотека',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

    // application components
    'components'=>array(
        'errorHandler'=>array(
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
                array(
                    'class'=>'CWebLogRoute',
                    'enabled' => YII_DEBUG,
                ),
            ),
        ),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=maximb74_library',
            'emulatePrepare' => true,
            'username' => 'maximb74_library',
            'password' => '6*d5hXQo',
            'charset' => 'utf8'
        ),
    )
);