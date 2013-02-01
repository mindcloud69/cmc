<?php
/*
 * Copyright 2012 - Phillip Tarrant
 * License: http://creativecommons.org/licenses/by-sa/3.0/deed.en_US
 */

if ( !defined('SYSTEM_DIR')) exit ('No direct script access allowed');

class pf_router
{
    public static $controller_directory = 'controllers'; //directory that holds controllers
    public static $default_controller = 'home'; //our default controller
    public static $default_action = 'index'; //our default action
    
    private $route = array();             //our route array
    
    /*
     * Parses the URL and finds the controller/action/params
     */
    public function parseURI()
    {
        //get the URI
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtolower(preg_replace('/[^a-zA-Z0-9]\//', "", $uri));
        $uri = strtok($uri, '?');
        
        //if no index.php in there we set everything as default and return it
        if (strpos($uri, INDEXPAGE) === false)
        {
            $this->route['CONTROLLER'] = self::$default_controller;
            $this->route['ACTION'] = self::$default_action;
            return $this->route;
        }
        
        //find where /index.php is in the uri
        $pos = strpos($uri, '/'.INDEXPAGE);
        
        //remove everything before and /index.php
        $uri = substr($uri, $pos +  strlen('/'.INDEXPAGE)); 
        
        //if nothing was after index.php the string is "false" so we check for that
        if (!$uri)
        {
            $this->route['CONTROLLER'] = self::$default_controller;
            $this->route['ACTION'] = self::$default_action;
            return $this->route; 
        }
        
        //remove the first / if there is one.
        if (substr($uri, 0,1)=="/")
        {
            $uri = substr($uri, 1);
        }
        
        /*if there is stuff left, it must be our controller and action
        so let's parse that   */
        
        //split the url up into parts
        $parts = explode('/', $uri);
        
        if (empty($parts[0])) 
        {
            $this->route['CONTROLLER'] = self::$default_controller;
        }
        else 
        {
            $this->route['CONTROLLER'] = $parts[0]; //the first part is the controller
            array_shift($parts); //remove the controller from the array
        }
        
        /*find/define the action page*/
        if (key_exists(0, $parts)) 
        {
            $this->route['ACTION']=$parts[0];
            array_shift($parts); //remove the action from the array
        }
        else
        {
            $this->route['ACTION'] = self::$default_action;
        }
        
        /*All other params we just pass along in an array*/
        if (key_exists(0, $parts)) 
        {
            $this->route['PARAMS']=$parts;
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
    
    public function setDefaultController($controller) {self::$default_controller = $controller;}
    public function setDefaultAction($action){self::$default_action=$action;}
    public function setControllerDirectory($dir) {self::$controller_directory = $dir;}
}
?>
