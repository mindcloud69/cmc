<?php
/*
 * Copyright 2012 - Phillip Tarrant
 * License: http://creativecommons.org/licenses/by-sa/3.0/deed.en_US
 */
if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');

class server_conf
{
    public static $server_data=array();
    private static $essentials_installed=false;
    public static $pluggins = array();
    
    public static function grabConfig($filename)
    {
        //for right now, we turn off errors (this isn't a proper ini file)
        ini_set('display_errors','Off');

        //check to make sure file is there.
        if (!file_exists($filename)) return false;//@todo: Throw error
        
        //$data=parse_ini_file($filename);
        $file = file_get_contents($filename);
        
        //break the file down to individual lines
        $lines = explode("\n",$file);
        
        $data = array();
        //for each line
        foreach ($lines as $line)
        {
            //if not a commented line
            if (substr($line, 0,1) !="#")
            {
                $tempdata = explode("=",$line);
                $data[$tempdata[0]]=$tempdata[1];
                
            }
        }
        foreach ($data as $setting=>$value)
        {
            if (!$value) $value='false';
            if (($setting=='level-seed') && ($value=='false')) $value='';
            if (($setting=='server-ip') && ($value=='false')) $value='';
            if (($setting=='generator-settings') && ($value=='false')) $value='';
            if (($setting=='texture-pack') && ($value=='false')) $value='';
            self::$server_data[$setting]=$value;
        }
        
        //turn errors back on
        ini_set('display_errors','On');
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
        $online = @fsockopen("127.0.0.1", 25565, $errno, $errstr, 1);
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
        
        echo "<table>";
        foreach ($player_files as $file) 
        {
            echo "<tr>";
            //get the last time it was modified
            $last_modified = date ('m-d-y h:i a',filemtime($file));
            //removes the dir
            $file = substr($file, strlen($world_dir.DIRECTORY_SEPARATOR . 'players/'));
            //removes the extention
            $file = substr($file, 0,-4);
            echo "<td>".$file . '</td> <td>last seen ' . $last_modified . "</td><td><a href='users/deluser.php?user=".$file."'>Delete User</a></td>";
            echo "</tr>";
            
        }
        echo "</table>";
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
}
?>
