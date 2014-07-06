<?php

// http://stackoverflow.com/questions/5683392/testing-restful-web-services-using-phpunit


class RequestTestCase extends PHPUnit_Framework_TestCase {
    public static $read = null;
    public static $write = null;

    public function readRequest($url, $method = 'GET', $params = array(), $noerrorexpected = true) {
        return $this->request(self::$read, $url, $method, $params, $noerrorexpected);
    }

    public function writeRequest($url, $method = 'GET', $params = array(), $noerrorexpected = true) {
        return $this->request(self::$write, $url, $method, $params, $noerrorexpected);
    }

    protected function request($api, $url, $method = 'GET', $params = array(), $noerrorexpected = true) {
        if (!empty($api)) {
            $response = $api->request($url, $method, $params);
            if ($noerrorexpected) {
                $this->assertTrue($response !== false, "API ERROR({$api->lastErrorCode}) : {$api->lastError}");
            }
            return $response;
        }
        return false;
    }

    public function readLastError() {
        return $this->lastError(self::$read);
    }

    public function writeLastError() {
        return $this->lastError(self::$write);
    }

    protected function lastError($api) {
        if (!empty($api)) {
            return array(
                'code'    => $api->lastErrorCode,
                'message' => $api->lastError,
            );
        }
        return false;
    }

    public function debug($msg) {
        echo $msg . "\n";
    }

    public static function assertCountAtLeast($expectedCount, $haystack, $message = '') {
        if (!is_int($expectedCount)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        if (!$haystack instanceof Countable &&
            !$haystack instanceof Iterator &&
            !is_array($haystack)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'countable');
        }

        self::assertThat(
          count($haystack),
          new PHPUnit_Framework_Constraint_GreaterThan($expectedCount),
          $message
        );
    }

    public static function assertArrayFields($fields, $haystack, $message = '') {
        if (!is_array($fields)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'array');
        }

        if (!$haystack instanceof Countable &&
            !$haystack instanceof Iterator &&
            !is_array($haystack)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'countable');
        }

        self::assertThat(
          count($haystack),
          new PHPUnit_Framework_Constraint_GreaterThan(0),
          $message
        );

        foreach ($fields as $field) {
            $item = current($haystack);
            if (!is_string($field)) {
                throw PHPUnit_Util_InvalidArgumentHelper::factory(0, 'string');
            }
            if (!is_object($item)) {
                throw PHPUnit_Util_InvalidArgumentHelper::factory(0, 'object');
            }
            self::assertThat(
              $item,
              new PHPUnit_Framework_Constraint_ObjectHasAttribute($field),
              $message
            );
            if (!next($haystack)) reset($haystack);
        }
        reset($haystack);
    }

    public static function assertObjectFields($fields, $item, $message = '') {
        if (!is_array($fields)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'array');
        }

        if (!is_object($item)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'object');
        }

        foreach ($fields as $field) {
            if (!is_string($field)) {
                throw PHPUnit_Util_InvalidArgumentHelper::factory(0, 'string');
            }
            self::assertThat(
              $item,
              new PHPUnit_Framework_Constraint_ObjectHasAttribute($field),
              $message
            );
        }
    }

    public static function assertUrlFQDN($url, $message = '') {
        $pattern = '/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)/i';

        if (!is_string($url)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $url = trim($url);

        if (preg_match('#^//#', $url)) {
            $url = 'http:' . $url;
        } else if (strpos($url, '://') === false) {
            $url = 'http://' . $url;
        }

        self::assertThat(
          $url,
          new PHPUnit_Framework_Constraint_PCREMatch($pattern),
          $message
        );
    }

    public static function assertImage($url, $message = '') {
        if (!is_string($url)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $url = trim($url);

        $info = getimagesize($url);

        self::assertThat(
          $info,
          new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_IsEmpty()),
          $message
        );
    }

}