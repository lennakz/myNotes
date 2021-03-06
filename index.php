<?php

// change the following paths if necessary
$yii='/home/lennakz/frameworks/yii1/framework/yii.php'; // Web
 
if (!file_exists($yii))
	$yii='/Users/admin/yii/framework/yii.php'; // Local
	 
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',false);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once('protected/globals.php');
require_once($yii);
Yii::createWebApplication($config)->run();
