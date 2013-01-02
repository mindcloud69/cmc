<?php
class server_control
{
    public static function log($message)
    {
        //get settings
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));

        $bukkit_dir = $settings->get('bukkit_dir');

        //our server log file
        $log = $bukkit_dir . DS . 'server.log';

        //current time
        $time = date('Y-m-d H:i:s');

        //log it in the server.log
        exec("echo $time [CMC] $message >> $log");  
    }
    
    public static function getBukkitDir()
    {
        //get settings
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        return $settings->get('bukkit_dir');
    }
    
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
    
    public static function removeCronJob($exec)
    {
        //get cron jobs minus the one with our exec
        $cron = shell_exec('crontab -l | grep -i -v "'.$exec.'"');
        
        file_put_contents('/tmp/newcron.txt', $cron);

        echo exec('crontab /tmp/newcron.txt');
    }
}

?>
