<?php
/*
 * Copyright 2012 - Phillip Tarrant
 * License: http://creativecommons.org/licenses/by-sa/3.0/deed.en_US
 */

if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');

abstract class pf_config
{
    private static $config = array();       //array to hold our config
    
    public static function get($setting)
    {
        //if the setting exist, we return it, else we return false
        return array_key_exists($setting, self::$config) ? self::$config[$setting] : FALSE;
    }
    
    public static function set($name,$setting)
    {
        self::$config[$name]=$setting;
    }
}
?>
