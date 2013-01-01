<?php
class log_server
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
}

?>
