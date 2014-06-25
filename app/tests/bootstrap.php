<?php

// change the following paths if necessary
$yiit=dirname(__FILE__).'/../../../yii/framework/yiit.php';
$config=dirname(__FILE__).'/../config/test.php';

$helpers = dirname(__FILE__).'/../helpers';

// AEA - WRlog helper
$wrlog = $helpers . '/wrlog.php';
require_once( $wrlog );
wrlog::$enabled = true;
wrlog::$path = dirname(__FILE__).'../../logs';
wrlog_request();

require_once($yiit);

// AEA - Globals for easy call to
$global = $helpers . '/global.php';
require_once($global);

//require_once(dirname(__FILE__).'/WebTestCase.php');

Yii::createWebApplication($config);
