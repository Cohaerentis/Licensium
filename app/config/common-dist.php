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
    ),

    // application components
    'components'    => array(
        'mail' => array(
            'class'         => 'application.extensions.mail.EMailer',
            'savePath'      => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
                               DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'emails',
            'CharSet'       => 'utf-8',
            'Host'          => 'localhost',
//            'Username'      => 'test@yourdomain.com',
//            'Password'      => 'test',
            'Mailer'        => 'smtp',
//            'Port'          => 26,
//            'SMTPAuth'      => true,
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
        'noReplyEmail' => 'noreply@yourdomain.com',
        'noReplyName'  => 'Licensium',
        'passwordSalt' => 'your-64-character-long-salt-for-hashing-passwords-xxxxxxxxxxxxxx',
        'languages' => array(
            'es'        => array('label' => 'ES', 'url' => '?lang=es'),
            'en'        => array('label' => 'EN', 'url' => '?lang=en'),
        ),
    ),
);
