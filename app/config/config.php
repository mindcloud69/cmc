<?php
/* =============================================================================
 * CONFIG.PHP - Configuration of the app
 * ===========================================================================*/
$config = array();

/* =============================================================================
 * APP SPECIFIC - Configuration of the app
 * ===========================================================================*/
//Our Timezone
$config['timezone']     ='America/New_York';

//our authors info
$config['author']       ='Phillip Tarrant';
$config['author_uri']   ='www.tarrants.net';

//site info
$config['site_name']    ='Crafty';
$config['keywords']     ='Minecraft Server Control Crafty';
$config['description']  ='A php app to control your minecraft serer';
$config['shortcut_icon']='icon.gif';
$config['creation_date']='2012';

/* =============================================================================
 * ENVIRONMENT - Configuration of the app
 * ===========================================================================*/
//set to any subfolder you have if not using one set to ''
$config['base_url']	= 'CMC'; 

//if  using mod_rewrite set this to ''
$config['index_page']   = 'index.php'; 

//this should be set to "DEV" or "LIVE"
$config['environment']  = 'DEV';


/* =============================================================================
 * ROUTER SETUP - Configuration of the app
 * ===========================================================================*/
//our default controller
$config['default_controller']= 'main';

//our default method
$config['default_method']= 'index';
?>
