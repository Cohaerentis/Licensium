<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/common.php'),
    array(
        'components' => array(
            'fixture' => array(
                'class'             => 'system.test.CDbFixtureManager',
            ),
        ),
        'params' => array(
            'selenium'  => array(
                'host'          => 'localhost',
                'browser'       => 'firefox',
                // 'browser'       => '*chrome',
                // 'browser'       => '*opera',
                'baseurl'       => 'http://baseurl.yourdomain.com',
            ),
        ),
    )
);
