<?php
/*
 * Copyright 2012 - Phillip Tarrant
 * License: http://creativecommons.org/licenses/by-sa/3.0/deed.en_US
 */
if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');

class CMC
{
    public static function getCMCSetting($setting)
    {
        $settings = new pf_json();
        $settings->readJsonFile(SETTINGS_FILE);
        return $settings->get($setting);
    }
    
    public static function writeCMCSetting($setting,$value)
    {
        $settings = new pf_json();
        $settings->readJsonFile(SETTINGS_FILE);
        $settings->set($setting, $value);
        $settings->writeJsonFile(SETTINGS_FILE);
    }
}
?>
