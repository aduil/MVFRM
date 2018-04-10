<?php

namespace lib;
/**
 * Registry
 */
class Registry
{
    private static $_instance = null;
    private static $datas = array();
    private function __construct()
    {
        self::$datas = array();
    }
    public static function getInstance()
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public static function set($name, $value)
    {
        self::$datas[$name] = $value;
        return true;
    }
    public static function get($key)
    {
        if(self::has($key)) {
            return self::$datas[$key];
        } else {
            return null;
        }
    }
    public static function has($key)
    {
        return isset(self::$datas[$key]);
    }
    public static function del($key)
    {
        unset(self::$datas[$key]);
        return true;
    }
    public function __clone()
    {
    }
}