<?php

class ControllerTestCase extends PHPUnit_Framework_TestCase {

    public function paramsSet($type = 'GET', $model = '', $params = array()) {
        $var = array();
        if (!empty($model)) {
            $var[$model] = $params;
        } else {
            $var = $params;
        }
        $GLOBALS['_' . $type] = $var;
    }

    public function fileSet($name, $filename, $filepath) {
        if (file_exists($filepath)) {
            $finfo = finfo_open();
            $info = finfo_file($finfo, $filepath);
            $type = explode("; ",$output);
            if ( is_array($type) ) $type = $type[0];
            $size = filesize($filepath);

            $_FILES[$name]['name'] = $filename;
            $_FILES[$name]['type'] = $type;
            $_FILES[$name]['size'] = $size;
            $_FILES[$name]['tmp_name'] = $filepath;
            $_FILES[$name]['error'] = 0;
        }
    }
}
