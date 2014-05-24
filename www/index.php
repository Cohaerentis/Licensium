<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../../yii/framework/yii.php';
$config=dirname(__FILE__).'/../app/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
error_reporting(E_ALL | E_STRICT);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 0);

$helpers = dirname(__FILE__).'/../app/helpers';

// AEA - WRlog helper
$wrlog = $helpers . '/wrlog.php';
require_once( $wrlog );
wrlog::$enabled = true;
wrlog::$path = dirname(__FILE__).'/../logs';
wrlog_request(array('get' => true, 'post' => true));

require_once($yii);

// AEA - Globals for easy call to
$global = $helpers . '/global.php';
require_once($global);

// AEA - Adding custom OAuth2 autoloader
// Yii::createWebApplication($config)->run();
$app = Yii::createWebApplication($config);

// Yii::import("application.modules.api.vendor.OAuth2.Autoloader", true);
// $oAuthLoader = new OAuth2\Autoloader(Yii::getPathOfAlias("application.modules.api.vendor"));
// Yii::registerAutoloader(array($oAuthLoader,'autoload'), true);

$app->run();
