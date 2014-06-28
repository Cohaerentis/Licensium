<?php
// Define APP_TEST for Funtional tests, uncommnet before execute phpunit in app/tests folder
// define('APP_TEST', true);

return CMap::mergeArray(
    require(dirname(__FILE__) . '/common.php'),
    array(
        // Comment this at production instance
    	/* */
        'modules' => array(
            'gii' => array(
                'class'     => 'system.gii.GiiModule',
                'password'  => 'yourgiipass',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                'ipFilters' => array('127.0.0.1','::1'),
            ),
        ),
	/* */
        'components' => array(
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
                'loginUrl'                  => array('/user/login'),
            ),
            // uncomment the following to enable URLs in path-format
            'urlManager' => array(
                'urlFormat'         => 'path',
                'showScriptName'    => false,
                'rules'             => array(
                    '<controller:\w+>/<id:\d+>'                 => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>'    => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'             => '<controller>/<action>',
                ),
            ),
            'errorHandler' => array(
                // use 'site/error' action to display errors
                'errorAction'       => 'site/error',
            ),
            'assets' => array(
                'class' => 'Assets',
            ),
        ),
        'params' => array(
            'ga' => array(
                'account'   => 'UA-XXXXXX-X',
                'domain'    => 'yourdomain.com',
            ),
        ),
    )
);

