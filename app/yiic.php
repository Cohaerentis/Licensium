<?php

// change the following paths if necessary
$yiic = dirname(__FILE__) . '/../../yii/framework/yiic.php';
$config = dirname(__FILE__) . '/config/console.php';

$helpers = dirname(__FILE__) . '/../app/helpers';

// AEA - WRlog helper
$wrlog = $helpers . '/wrlog.php';
require_once( $wrlog );
wrlog::$enabled = true;
wrlog::$path = dirname(__FILE__).'/../logs';
wrlog_request(array('args' => true));

// AEA - Globals for easy call to
$global = $helpers . '/global.php';
require_once($global);

require_once($yiic);

