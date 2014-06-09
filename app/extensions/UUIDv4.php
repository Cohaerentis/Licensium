<?php

/**
 * Simple UUIDv4 generator.
 *
 * Based on class UUID from J. King (http://jkingweb.ca/), MIT license
 * See http://jkingweb.ca/code/php/lib.uuid/
 *
 */

class UUIDv4 {
    const CLEAR_VERSION     = 15;  // 00001111  Clears all bits of version byte with AND
    const CLEAR_VARIANT     = 63;  // 00111111  Clears all relevant bits of variant byte with AND
    const SET_VERSION4      = 64;  // 01000000
    const SET_VARIANT_RFC   = 128; // 10000000  The RFC 4122 variant (this variant)

    public $bytes = array();
    public $string = '';

    protected static function randomBytes($bytes) {
        $rand = "";
        for ($a = 0; $a < $bytes; $a++) {
            $rand .= chr(mt_rand(0, 255));
        }
        return $rand;
    }

    public static function create() {
        $uuid = new self();

        $bytes = self::randomBytes(16);
        // set variant
        $bytes[8] = chr(ord($bytes[8]) & self::CLEAR_VARIANT | self::SET_VARIANT_RFC);
        // set version
        $bytes[6] = chr(ord($bytes[6]) & self::CLEAR_VERSION | self::SET_VERSION4);

        $uuid->bytes = $bytes;
        $uuid->string =
           bin2hex(substr($bytes,0,4))."-".
           bin2hex(substr($bytes,4,2))."-".
           bin2hex(substr($bytes,6,2))."-".
           bin2hex(substr($bytes,8,2))."-".
           bin2hex(substr($bytes,10,6));

        return $uuid;
    }
}