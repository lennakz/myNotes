<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'My Notes',
	// preloading 'log' component
	'preload' => array('log'),
	// language
	'language' => 'en',
	// timezone
	'timeZone' => 'America/Vancouver',
	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
	),
	'modules' => array(
		// uncomment the following to enable the Gii tool

		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1', '::1'),
		),
	),
	// application components
	'components' => array(
		'clientScript' => array(
			// disable default yii scripts
			'scriptMap' => array(
				'jquery.js' => false,
				'jquery.min.js' => false//'../../js/jquery-3.2.1.min.js' //'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js',
			//'jquery-ui.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'
			//'core.css'      => false,
			//'styles.css'    => false,
			//'pager.css'     => false,
			//'default.css'   => false,
			),
			'packages' => array(
				'jquery' => array(
					'baseUrl' => 'js/',
					'js' => array('jquery-3.2.1.min.js'),
				),
				'bootstrap' => array(
					'baseUrl' => 'bootstrap/',
					'js' => array('bootstrap.min.js'),
					'css' => array(
						'bootstrap.min.css'
					),
					'depends' => array('jquery'), // cause load jquery before load this.
				),
			),
		),
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager' => array(
			'urlFormat' => 'path',
			'rules' => array(
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				'<action:[\w\-]+>' => 'site/<action>',
			),
		),
		// database settings are configured in database.php
		'db' => array(
			'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/data.sqlite',
		),
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => YII_DEBUG ? null : 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class' => 'CWebLogRoute',
				),
			),
		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'mykola.kotok@gmail.com'
	),
);
