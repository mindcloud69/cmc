<?php
/*
 * Copyright 2012 - Phillip Tarrant
 * License: http://creativecommons.org/licenses/by-sa/3.0/deed.en_US
 */
/* =============================================================================
 * AUTOLOADER - here we setup our auto-loading of classes
 * ===========================================================================*/
    
    function __autoload($class_name)
    {
        if (file_exists(SYSTEM_DIR.'core'.DS.$class_name.'.php'))
        {
            pf_events::eventsAdd('Autoloading Class: '.SYSTEM_DIR.'core'.DS.$class_name.'.php');
            include(SYSTEM_DIR.'core'.DS.$class_name.'.php');
            return true;
        }
        pf_events::eventsAdd('Unable to Autoload Class: ' . $class_name);
        pf_events::dispayFatal('Application Error: File Not Found');
        return false;
    }
    
/* =============================================================================
 * APP SETTINGS
 * ===========================================================================*/
    define('APP_NAME','Crafty Minecraft Controller');
    define('APP_VERSION', '1.2.8-Beta-build:1');

/* =============================================================================
 * BASIC SETTINGS - used for increased readablity
 * ===========================================================================*/
    //Define Directory Seperator, its a global, but this is shorter
    define ('DS', DIRECTORY_SEPARATOR); 
    
    //define the root directory (base path) lll
    define ('SERVER_ROOT', realpath(dirname(__FILE__)). DS);
    
    //define where the system dir is (where all framework stuff is)
    define ('SYSTEM_DIR', SERVER_ROOT . 'system' . DS);
    
    //define where the public files are
    define ('APPLICATION_DIR', SERVER_ROOT . 'app' . DS);

/* =============================================================================
 * READ SETTINGS - sets up app after loading the config.php file
 * ===========================================================================*/    
    //load settings file with our config and our events logger
    require_once (SYSTEM_DIR.'core'.DS.'pf_config.php'); //loads our settings class
    require_once (SYSTEM_DIR.'config'.DS. 'config.php'); //loads our config

/* =============================================================================
 * EVENTS REPORTING - setup events reporting/timezone
 * ===========================================================================*/

    //manually load our logging/error system (pf_events.php)
    require_once (SYSTEM_DIR.'core'.DS.'pf_events.php');
    pf_events::eventsAdd('pf_events Loaded');
    
    //setting of timezone
    date_default_timezone_set(TIMEZONE); 
    pf_events::eventsAdd('Timezone set: '.TIMEZONE);

    //setup environment
    if (ENVIRONMENT == 'DEV')
    {
        //setup error reporting
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        pf_events::eventsAdd('Displaying All Errors');

        //set basepath
        
        pf_config::set('base_path', DEVPATH);
        pf_events::eventsAdd('base_path set to: '.DEVPATH);

        //setup pf_events
        pf_events::$show_debug=true;
        pf_events::eventsAdd('Environment Set To DEV');
    }
    else
    {
        //setup error reporting
        error_reporting(0);
        ini_set("display_errors", 0);
        pf_events::eventsAdd('Displaying NO Errors');
        
        //set basepath
        pf_config::set('base_path', LIVEPATH);
        pf_events::eventsAdd('base_path set to: '.LIVEPATH);

        //setup pf_events
        pf_events::$show_debug=false;
        pf_events::eventsAdd('Environment Set To LIVE');
    }

/*
 * Autoload
 */    
    if (file_exists(SYSTEM_DIR.'config'.DS.'autoload.php')) 
            require_once SYSTEM_DIR.'config'.DS.'autoload.php';
    
/* =============================================================================
 * OUTPUT BUFFERING - Turns it on, This is VERY useful for us.
 * ===========================================================================*/    
    pf_events::eventsAdd('Starting Output Buffering');
    if (!ob_start()) ob_start ();
    
/* =============================================================================
 * TURN ON SESSIONS - Turns on sessions for later
 * ===========================================================================*/        
    session_start();
    pf_events::eventsAdd('Sessions Started');
    
/* =============================================================================
 * CONFIG BASE URL - Needed for all pf_html settings, and just useful in general
 * ===========================================================================*/
    
    //if in /var/www and no subfolder
    if (pf_config::get('base_path')=='')
    {
        pf_config::set('base_url', 'http://'.$_SERVER['HTTP_HOST'].'/');
        pf_events::eventsAdd('base_url set to: '.'http://'.$_SERVER['HTTP_HOST'].'/');
    }
    //if using a subfolder
    else 
    {
        pf_config::set('base_url', 'http://'.$_SERVER['HTTP_HOST'].'/'.pf_config::get('base_path').'/');
        pf_events::eventsAdd('base_url set to: '.'http://'.$_SERVER['HTTP_HOST'].'/'.pf_config::get('base_path').'/');
    }
    
    //if not using an index page (mod_rewrite)
    if (INDEXPAGE == '')
    {
        pf_config::set('main_page', pf_config::get('base_url'));
        pf_events::eventsAdd('main_page set to: '. pf_config::get('main_page'));
    }
    else
    {
        pf_config::set('main_page', pf_config::get('base_url') . INDEXPAGE);
        pf_events::eventsAdd('main_page set to: '. pf_config::get('main_page'));
    }
    
/* =============================================================================
 * MOAR DEFINES - These are to help shorten calls to common things
 * ===========================================================================*/    
    define('BASE_URL',  pf_config::get('base_url'));
    define('MAIN_PAGE', pf_config::get('main_page'));
    define('ASSETS_DIR', BASE_URL . 'app/assets');
    define('SETTINGS_FILE',  pf_config::get('Json_Settings'));
    define('DB_FILE',  pf_config::get('SQLite_DB'));
    
    
/* =============================================================================
 * ROUTER - Load/Configure the router object and do routing
 * ===========================================================================*/
    
    //create a router
    pf_events::eventsAdd('Creating Router Object');
    if (!$router=new pf_router())
    {
        pf_events::eventsAdd('Creating Router Object Failed');
    }
    
    
    //if we don't have a base_url, or index_page assigned we throw an error
    if ((!pf_config::get('base_url')) || (!pf_config::get('main_page')))
    {
        pf_events::dispayFatal('Base_url or index_page not set!');
    }
    
   pf_events::eventsAdd('Setting Base URL for Router to: ' . pf_config::get('main_page'));
    $router->setBaseURL(pf_config::get('main_page'));
    
    //set the router controller dir
    pf_events::eventsAdd("Setting router controller dir to: ". APPLICATION_DIR.'controllers'.DS);
    $router->setControllerDirectory(APPLICATION_DIR.'controllers'.DS);
    
    //set the router default controller
    pf_events::eventsAdd("Setting default controller file/class to: ".pf_config::get('default_controller'));
    $router->setDefaultController(pf_config::get('default_controller'));
    
    //set the default action to call
    pf_events::eventsAdd('Setting default action method to: '. pf_config::get('default_method'));
    $router->setDefaultAction(pf_config::get('default_method'));
    
    //parse the URL
    pf_events::eventsAdd('Getting requested URL');
    $route = $router->parseURI();
    pf_config::set('ROUTE', $route);
    //require the controller file
    pf_events::eventsAdd('Loading Controller: '.APPLICATION_DIR.'controllers'.DS.$route['CONTROLLER'].".php");
    
    //if no controller there throw a 404 page at them and throw a fatal error
    if(!$router->loadController($route['CONTROLLER'])) 
    {
        pf_events::eventsAdd('Failed to load Controller: '.APPLICATION_DIR.'controllers'.DS.$route['CONTROLLER'].".php");
        pf_events::display404('The Page Requested Was Not Found');
    }
    
    //create a new controller object
    pf_events::eventsAdd('Creating New Controller Object: '.$route['CONTROLLER'] );
    $controller = new $route['CONTROLLER'];
    
    //check to see if the action exist, if so we call it
    pf_events::eventsAdd('Checking for method: '.$route['ACTION']);
    if (method_exists($controller, $route['ACTION'])) //if the method exist
    {
        //clear anyheader info here
        pf_events::eventsAdd('Clearing Any Page Output');
        pf_html::clearPreviousBuffer();
        
        //since the page is about to load and we don't need anything that was buffered at this point we 
        pf_events::eventsAdd('Calling Action: '.$route['ACTION']);
        call_user_func(array($controller,$route['ACTION'])); //call the action assigned.
    }
    
    //if we failed to load the action, we throw a fatal error and a 404 :)
    else 
    {
        pf_events::eventsAdd('Failed to load action: '.$route['ACTION'].".php");
        pf_events::display404('The Page Requested Was Not Found');
    }
?>