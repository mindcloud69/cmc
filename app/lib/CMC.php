<?php
/*
 * Copyright 2012 - Phillip Tarrant
 * License: http://creativecommons.org/licenses/by-sa/3.0/deed.en_US
 */
if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');

class CMC
{
    //gets a setting out of our json file
    public static function getCMCSetting($setting)
    {
        $settings = new pf_json();
        $settings->readJsonFile(SETTINGS_FILE);
        return $settings->get($setting);
    }
    
    //saves settings to our json file
    public static function writeCMCSetting($setting,$value)
    {
        $settings = new pf_json();
        $settings->readJsonFile(SETTINGS_FILE);
        $settings->set($setting, $value);
        $settings->writeJsonFile(SETTINGS_FILE);
    }
    
    //logs to server.log
    public static function log($message)
    {
        //get bukkit_dir
        $bukkit_dir = self::getCMCSetting('bukkit_dir');

        //our server log file
        $log = $bukkit_dir . DS . 'server.log';

        //current time
        $time = date('Y-m-d H:i:s');

        //log it in the server.log
        exec("echo $time [CMC] $message >> $log");  
    }
    
    //creates a cronjob
    public static function createCronJob($times,$exec)
    {
        //get old cron jobs
        $cron = shell_exec('crontab -l');

        //see if there are no crons for this user
        if (pf_core::compareStrings($cron, 'no crontab for www-data'))
        {
            $cron = '';
        }
        
        //build the new cron
        $newcron=$times. " " . $exec.PHP_EOL;

        file_put_contents('/tmp/newcron.txt', $cron.$newcron);

        echo exec('crontab /tmp/newcron.txt');
    
    }
    
    //removes a cronjob
    public static function removeCronJob($exec)
    {
        //get cron jobs minus the one with our exec
        $cron = shell_exec('crontab -l | grep -i -v "'.$exec.'"');
        
        file_put_contents('/tmp/newcron.txt', $cron);

        echo exec('crontab /tmp/newcron.txt');
    }
}
?>
