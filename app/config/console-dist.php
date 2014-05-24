<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath'      => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'          => 'Licensium CLI',

    // preloading 'log' component
    'preload'       => array('log'),

    // autoloading model and component classes
    'import'        => array(
        'application.models.*',
        'application.components.*',
    ),

    // application components
    'components'    => array(
        'db' => array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
            // MySQL database sample
            // 'connectionString' => 'mysql:host=localhost;dbname=yourdbname',
            // 'username' => 'yourdbuser',
            // 'password' => 'yourdbpass',
            // 'charset' => 'utf8',
        ),
        'log' => array(
            'class'             => 'CLogRouter',
            'routes'            => array(
                array(
                    'class'     => 'CFileLogRoute',
                    'levels'    => 'error, warning',
                ),
            ),
        ),
        'cache' => array(
            'class' => 'system.caching.CMemCache',
            'servers' => array(
                array('host'            => 'localhost',
                      'port'            => 11211,
                      'weight'          => 100,
                      'retryInterval'   => 600,
                      'status'          => true,
                ),
            ),
            'useMemcached' => true,
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'        => array(
        'contactEmail' => 'info@yourdomain.com',
        'passwordSalt' => 'your-64-character-long-salt-for-hashing-passwords-xxxxxxxxxxxxxx',
    ),
);