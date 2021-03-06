<?php
/* =============================================================================
 * CONFIG.PHP - handles our config of the app
 * ===========================================================================*/

/* =============================================================================
 * ENVIRONMENT - Your server settings, Feel free to change these as you need.
 * ===========================================================================*/
//Our Timezone
define('TIMEZONE','America/New_York');

//this should be set to "DEV" or "LIVE"
define('ENVIRONMENT','DEV'); //<-- default LIVE (the dev's many times kinda forget to change this)

//set to any subfolder you have if not using one set to ''
define('DEVPATH',''); //our dev subfolder if any <-- this is mainly used by developers
define('LIVEPATH',''); //our live subfolder if any <- any folder inside /var/www

//Your index page, this MUST BE SET!
define('INDEXPAGE', 'index.php');

/* =============================================================================
 * WARNING - WARNING - WARNING - WARNING - WARNING - WARNING - WARNING - WARNING
 * =============================================================================
 *                               DRAGONS AHEAD
 * 
 * Below are settings used by the app. None of these pertain to your server or
 * setup. This entire system is based on my framework (pf_frame), these settings
 * are used by that framework to do it's task. Later this might be streamlined
 * and lots of these settings setup as defines instead of var's inside a class.
 * However, for now, we are keeping this as flexible as possible. 
 * 
 * In short - DON'T TOUCH BELOW HERE!
 * 
 * Thank you
 * Phillip and the other devs.
 * ===========================================================================*/




/* =============================================================================
 * APP SPECIFIC - Configuration of the app
 * ===========================================================================*/
//our authors info
pf_config::set('author', 'Phillip Tarrant');
pf_config::set('author_uri', 'https://github.com/ptarrant/cmc');

//site info
pf_config::set('site_name', 'Crafty Minecraft Control');
pf_config::set('keywords', 'Minecraft Server Control Crafty');
pf_config::set('description', 'A PHP app to control your minecraft server');
pf_config::set('shortcut_icon', 'icon.gif');
pf_config::set('creation_date', '2012');


/* =============================================================================
 * ROUTER SETUP - Configuration of the router
 * ===========================================================================*/
//our default controller (main is default)
pf_config::set('default_controller', 'main');

//our default method (index is default)
pf_config::set('default_method', 'index');

//our default login page
pf_config::set('login_page', 'login');

/* =============================================================================
 * ASSETS SETUP - Configuration of the Assets Dir
 * ===========================================================================*/
pf_config::set('stylesheet_dir', 'app/assets/css/');
pf_config::set('java_dir', 'app/assets/js/');

/* =============================================================================
 * SETTINGS SETUP - Our Json File to use for settings and DB
 * ===========================================================================*/
pf_config::set('Json_Settings', APPLICATION_DIR.'config'.DS.'settings.json');
pf_config::set('SQLite_DB',APPLICATION_DIR.'config'.DS.'CMC.db');
/* =============================================================================
 * REQUIRED VERSIONS - Our Required Versions of required sofware
 *                     I am using an array so if we need to add stuff later we can.
 * ===========================================================================*/
$required = array('PHP'=>5.3);
pf_config::set('requirements',$required);
?>
