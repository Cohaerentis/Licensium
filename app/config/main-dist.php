<?php

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'          => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'              => 'Licensium',
    'sourceLanguage'    => 'en',   // Code language
    'language'          => 'es',   // Default language

    // preloading 'log' component
    'preload'       => array('log'),

    // path aliases
    'aliases'       => array(
    ),

    // autoloading model and component classes
    'import'        => array(
        'application.models.*',
        'application.components.*',
        'application.vendor.*',
        'application.extensions.*',
    ),

    'modules'       => array(
        // uncomment the following to enable the Gii tool
        /* * /
        'gii' => array(
            'class'     => 'system.gii.GiiModule',
            'password'  => 'your-gii-password',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        /* */
    ),

    // application components
    'components'    => array(
        'clientScript' => array(
            'coreScriptPosition'        => 2,
            'defaultScriptFilePosition' => 2,
            'packages'                  => array(
                'jquery' => array(
                    'baseUrl'   => false,
                    'js'        => false,
                ),
            ),
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin'            =>true,
            'loginRequiredAjaxResponse' => '<div class="redirect"><div class="url">/user/login</div></div>',
        ),
        // uncomment the following to enable URLs in path-format
        /* */
        'urlManager' => array(
            'urlFormat'         => 'path',
            'showScriptName'    => false,
            'rules'             => array(
                '<controller:\w+>/<id:\d+>'                 => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'    => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>'             => '<controller>/<action>',
            ),
        ),
        /* */
        'db' => array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
            // MySQL database sample
            // 'connectionString' => 'mysql:host=localhost;dbname=yourdbname',
            // 'username' => 'yourdbuser',
            // 'password' => 'yourdbpass',
            // 'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction'       => 'site/error',
        ),
        'log' => array(
            'class'             => 'CLogRouter',
            'routes'            => array(
                array(
                    'class'     => 'CFileLogRoute',
                    'levels'    => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'     => 'CWebLogRoute',
                ),
                */
            ),
        ),
        'assets' => array(
            'class' => 'Assets',
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