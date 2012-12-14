<?php
/* =============================================================================
 * CONFIG.PHP - handles our config of the app
 * ===========================================================================*/

/* =============================================================================
 * APP SPECIFIC - Configuration of the app
 * ===========================================================================*/
//our authors info
pf_config::set('author', 'Phillip Tarrant');
pf_config::set('author_uri', 'www.tarrants.net');

//site info
pf_config::set('site_name', 'Crafty Minecraft Control');
pf_config::set('keywords', 'Minecraft Server Control Crafty');
pf_config::set('description', 'A PHP app to control your minecraft server');
pf_config::set('shortcut_icon', 'icon.gif');
pf_config::set('creation_date', '2012');

/* =============================================================================
 * ENVIRONMENT - Some server settings
 * ===========================================================================*/
//Our Timezone
pf_config::set('timezone', 'America/New_York');

//set to any subfolder you have if not using one set to ''
pf_config::set('base_path', 'cmc');

//if  using mod_rewrite set this to ''
//if you are using mod_rewrite, don't forget to change your links to remove the index.php
pf_config::set('index_page', 'index.php');

//this should be set to "DEV" or "LIVE"
pf_config::set('environment', 'DEV');

/* =============================================================================
 * ROUTER SETUP - Configuration of the router
 * ===========================================================================*/
//our default controller (main is default)
pf_config::set('default_controller', 'main');

//our default method (index is default)
pf_config::set('default_method', 'index');

/* =============================================================================
 * ASSETS SETUP - Configuration of the Assets Dir
 * ===========================================================================*/
pf_config::set('stylesheet_dir', 'app/assets/css/');
pf_config::set('java_dir', 'app/assets/js/');


/* =============================================================================
 * YOUR VARIABLES - A place for all your variables
 * ===========================================================================*/

?>
