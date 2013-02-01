<?php
/*
 * Copyright 2012 - Phillip Tarrant
 * License: http://creativecommons.org/licenses/by-sa/3.0/deed.en_US
 */
if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');

class mcController
{
    //some vars
    public static $server_data=array();                 //our server data from the config file
    private static $essentials_installed=false;         //is essentials pluggin installed
    public static $pluggins = array();                  //other pluggings detected
    
    public static function getMCConfig($filename)
    {
        //check to make sure file is there.
        if (!file_exists($filename)) return false;

        //grab the file contents
        $file = file_get_contents($filename);
        
        //break the file down to individual lines
        $lines = explode("\n",$file);
        
        //create a data array
        $data = array();
        
        //for each line
        foreach ($lines as $line)
        {
            //if not a commented line
            if ( (substr($line, 0,1) !="#") && $line !== '')
            {
                //split it into an array like value = setting
                $tempdata = explode("=",$line);
                
                //add the parts to the data array
                if ( (key_exists(0, $tempdata)) && (key_exists(1, $tempdata)) )
                {
                    $data[$tempdata[0]]=$tempdata[1]; 
                }
                
            }
        }
        
        //for each setting we so some basic checks and such
        foreach ($data as $setting=>$value)
        {
            if (!$value) $value='false';
            if (($setting=='level-seed') && ($value=='false')) $value='';
            if (($setting=='server-ip') && ($value=='false')) $value='';
            if (($setting=='generator-settings') && ($value=='false')) $value='';
            if (($setting=='texture-pack') && ($value=='false')) $value='';
            self::$server_data[$setting]=$value;
        }
        
        return true;
    }
    
    public static function savesetting($setting,$value)
    {
        self::$server_data[$setting]=$value;
    }
    public static function getSetting($setting,$as_String=false)
    {
        if (key_exists($setting, self::$server_data))
        {
            if ($as_String)
            {
                return (string)self::$server_data[$setting];
            }
            return self::$server_data[$setting];
        }
        else return false;
    }
    
    public static function checkOnline()
    {
        if (empty(self::$server_data)) //if server_data is empty, we grab config
        {
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        self::getMCConfig($bukkit_dir.DS.'server.properties');
        }
        
        //get our server port
        $port = self::getSetting('server-port');
        
        if (!$port) $port = '25565'; //set to default if undefined/false
        
        $online = @fsockopen("127.0.0.1", $port, $errno, $errstr, 1);
        if ($online) return true;
        else return false;
    }
    
    public static function countPlayerFiles($world_dir)
    {
        $player_files = glob($world_dir . DIRECTORY_SEPARATOR . 'players/*.dat');
        return count($player_files);
    }
    
    public static function displayPlayers($world_dir)
    {
        $player_files = glob($world_dir .'/players/*.dat');
        
        $playersinfo = array();
        foreach ($player_files as $file) 
        {
            //get the last time it was modified
            $last_modified = date ('m-d-y h:i a',filemtime($file));

            //removes the dir
            $file = substr($file, strlen($world_dir.DIRECTORY_SEPARATOR . 'players/'));
            
            //removes the extention
            $player = substr($file, 0,-4);
            $playersinfo[] = array('last_seen' => $last_modified,'name' => $player);
        }
        
        return $playersinfo;
        
    }
    
    public static function checkEssentials($bukkit_dir)
    {
        if (file_exists($bukkit_dir.DS.'plugins/Essentials.jar'))
        {
            self::$essentials_installed=true;
            return true;
        }
        else return false;
    }
    
    public static function checkPluggins($bukkit_dir)
    {
        //list all jar files in plugins
        $pluggins = glob($bukkit_dir.DS.'plugins/*.jar');
        
        //for every plugin, we add to a the array
        foreach ($pluggins as $plugin)
        {
            $plugin = substr($plugin,  strlen($bukkit_dir.DS.'plugins/'));
            $plugin = substr($plugin,0,-4);
            self::$pluggins[]=$plugin;
        }
        return self::$pluggins;
    }
    
    public static function CPUUsage()
    {
        //display cpu and mem usage of java
        $command = 'ps -eo comm,%cpu,%mem | grep java';
        
        //display number of processes using "java"
        $javacount = 'ps -eo comm,%cpu,%mem | grep -c java';
        
        //some string processing
        $return = substr(exec($command), -9);
        $info = explode('  ', $return);
                
        //if more than 1 java
        if (exec($javacount) > 1)
        {
         $info['MultiJavas']=TRUE;
        }
        else $info['MultiJavas']=FALSE;
        
        //display number of cores
        $info['cores'] = intval(exec('nproc'));
        
        return $info;
    }
    
    public static function serverStatus($host){
        $socket = @fsockopen($host, 25565, $errno, $errstr);
   
        if ($socket === false){
            return false;
        }
   
        fwrite($socket, "\xfe\x01");
   
        $data = fread($socket, 256);
   
        if (substr($data, 0, 1) != "\xff"){
            return false;
        }
   
        if (substr($data, 3, 5) == "\x00\xa7\x00\x31\x00"){
            $data = explode("\x00", mb_convert_encoding(substr($data, 15), 'UTF-8', 'UCS-2'));
        }else{
            $data = explode('§', mb_convert_encoding(substr($data, 3), 'UTF-8', 'UCS-2'));
        }
   
        if (count($data) == 3){
            $info = array(
                'version'        => '1.3.2',
                'motd'            => $data[0],
                'players'        => intval($data[1]),
                'max_players'    => intval($data[2]),
                'online'         => TRUE
            );
        }else{
            $info = array(
                'version'        => $data[0],
                'motd'            => $data[1],
                'players'        => intval($data[2]),
                'max_players'    => intval($data[3]),
                'online'         => TRUE
            );
        }
   
        return $info;
    }
    
    public static function serverSend($command)
    {
        $command = "screen -S bukkit -p 0 -X stuff '".$command."\n' ";
        exec($command);
    }
}
?>
