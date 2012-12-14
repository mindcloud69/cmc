<?php if ( !defined('SYSTEM_DIR')) exit ('No direct script access allowed');
/*
 * File: class_router.php
 * Purpose: Handles All Routing and Dispatches
 * Author: Phillip Tarrant
 * License: See license.txt in Root Folder
 * Created: 9/4/2012
 * 
 * Changelog:
 * 9/5/2012 - if no action specified, the default is used.
 */

class pf_router
{
    public static $basepath; //our base path for the app (subfolder)
    public static $controller_directory = 'controllers'; //directory that holds controllers
    public static $default_controller = 'home'; //our default controller
    public static $default_action = 'index'; //our default action
    
    
    private $route = array();             //our route array
    
    /*
     * Parses the URL and finds the controller/action/params
     */
    public function parseURI()
    {
        
        $basepath = strtolower(self::$basepath);
        
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        $path = strtolower(preg_replace('/[^a-zA-Z0-9]\//', "", $path));
        
        //remove basepath from path
        if (strpos($path, $basepath) === 0) 
        {
            $path = substr($path, strlen($basepath));
        }
        //remove first /
        $path = substr($path, 1); //remove the first /
        
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
    
    public function setBasepath($basepath) {self::$basepath = $basepath;}
    public function setDefaultController($controller) {self::$default_controller = $controller;}
    public function setDefaultAction($action){self::$default_action=$action;}
    public function setControllerDirectory($dir) {self::$controller_directory = $dir;}
}
?>
