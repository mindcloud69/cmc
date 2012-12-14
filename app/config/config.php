<?php
/* =============================================================================
 * Config.php - Configuration of the app
 * ===========================================================================*/
$config = array();


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

//set to any subfolder you have
$config['base_url']	= 'CMC'; 

//if  using mod_rewrite set this to ''
$config['index_page']   = 'index.php'; 

//this should be set to "DEV" or "LIVE"
$config['environment']  = 'DEV'

?>
