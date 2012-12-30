<?php
/*
 * Copyright 2012 - Phillip Tarrant
 * License: http://creativecommons.org/licenses/by-sa/3.0/deed.en_US
 */

if ( !defined('SYSTEM_DIR')) exit ('No direct script access allowed');

class pf_router
{
    public static $baseURL; //our base path for the app (subfolder)
    public static $controller_directory = 'controllers'; //directory that holds controllers
    public static $default_controller = 'home'; //our default controller
    public static $default_action = 'index'; //our default action
    
    
    private $route = array();             //our route array
    
    /*
     * Parses the URL and finds the controller/action/params
     */
    public function parseURI()
    {
        //setup the base path (basically anything after the base_url (determined by index.php)
        $basepath = strtolower(self::$baseURL);
        $basepath = substr($basepath, strlen(pf_config::get('base_url')));
        
        //get path
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        $path = strtolower(preg_replace('/[^a-zA-Z0-9]\//', "", $path));
        
        //remove basepath from path
        if (strpos($path, $basepath) === 0) 
        {
            $path = substr($path, strlen($basepath));
        }
        
        //remove the first /
        if (substr($path, 0,1)=="/")
        {
            $path = substr($path, 1);
        }
        
        //convert URL parts into array
        $url_parts = explode("/",$path,2); //explode the URI into parts

        
        
        /*if no page specified we use the default*/
        if (empty($url_parts[0])) 
            $this->route['CONTROLLER'] = self::$default_controller;
        else 
            $this->route['CONTROLLER'] = $url_parts[0]; //the first part is the controller}
        
        /*find/define the action page*/
        if (key_exists(1, $url_parts)) 
        {
            $this->route['ACTION']=$url_parts[1];
        }
        else
            $this->route['ACTION'] = self::$default_action;
        
        /*All other params we just pass along in an array*/
        if (key_exists(2, $url_parts)) 
        {
            $this->route['PARAMS']=explode("/", $url_parts[1]);
        }
        
        return $this->route;
    }
    
    public function loadController($filename)
    {
        $filename=self::$controller_directory.$filename.".php";

        if(file_exists($filename)) 
            {
            require_once $filename;
            return true;
            }
        else return false;
    }
    
    public function setBaseURL($baseURL) {self::$baseURL = $baseURL;}
    public function setDefaultController($controller) {self::$default_controller = $controller;}
    public function setDefaultAction($action){self::$default_action=$action;}
    public function setControllerDirectory($dir) {self::$controller_directory = $dir;}
}
?>
