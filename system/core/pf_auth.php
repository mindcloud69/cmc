<?php
/*
 * Copyright 2012 - Phillip Tarrant
 * License: http://creativecommons.org/licenses/by-sa/3.0/deed.en_US
 */

if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');

class pf_auth {
    
    public static function saveVar($var,$data)
    {
        $_SESSION[$var]=$data;
    }
    
    public static function getVar($var)
    {
        if (key_exists($var, $_SESSION))return $_SESSION[$var];
        else return false;
    }
    
    public static function delVar($var)
    {
        if (key_exists($var, $_SESSION))unset($_SESSION[$var]);
    }
    
    public static function setLoggedin($value=null)
    {
        if (isset($value)) self::saveVar ('loggedin', $value);
        self::saveVar('loggedin', TRUE);
    }
    
    public static function checkLogin()
    {
        if (!self::getVar('loggedin'))
        {
            return false;
        }
        
        return true;
    }
    
    public static function loggout()
    {
        $_SESSION=array();
        session_destroy();
    }
}

?>
