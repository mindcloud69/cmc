<?php

class main extends pf_controller
{
    public function index()
    {
        
        //if we don't have a bukkit dir, we go to the install controller
        if (!CMC::getCMCSetting('bukkit_dir'))
        {
            pf_core::redirectUrl(MAIN_PAGE.'/install');
        }
        
        
        $data = array();
        
        //get our bukkit dir
        $data['bukkit_dir'] = CMC::getCMCSetting('bukkit_dir');
        
        //get last backup
        $data['last_backup']=CMC::getCMCSetting('last_backup');
        
        //load the server.properties, if not there, we throw an error in their face
        if (!mcController::getMCConfig($data['bukkit_dir'].'/server.properties'))
        {
            
            pf_events::dispayFatal('Unable To Find Server.Properties!<br /><a href="'.MAIN_PAGE.'/install">Click Here To Install/Reinstall</a>');
        }
        
        //check if logged in
        $this->checkLogin();
        
        //get some info from the config file
        $data['online']=mcController::checkOnline();
        $data['world'] = mcController::getSetting('level-name');
        $data['pvp'] = mcController::getSetting('pvp');
        //$data['difficulty'] = server_conf::getSetting('difficulty');
        $data['difficulty'] = mcController::getSetting('difficulty');
        $essentials = mcController::checkEssentials($data['bukkit_dir']);

        $gamemode= mcController::getSetting('gamemode');
        if ($gamemode == 0) $gamemode = 'Survival';
        elseif ($gamemode == 1) $gamemode = 'Creative';
        elseif ($gamemode == 1) $gamemode = 'Adventure';
        
        if ($essentials) $data['essentials']='TRUE';
        else $data['essentials'] = 'FALSE';
        
        $data['gamemode'] = $gamemode;
        
        $list = '';
        mcController::checkPluggins($data['bukkit_dir']);
        foreach (mcController::$pluggins as $plugin)
        {
            $list .= ", ".$plugin;
        }
        
        $data['pluggins']=$list;

        //do we have the auto-restart enabled?
        $current_cron = exec('crontab -l | grep "server/restart"');
        if (strpos($current_cron, 'server/restart'))
        {
            $data['current_cron']=TRUE;
        }
        else $data['current_cron']=FALSE;
        
        //load our main page
        $this->loadView('main_page',$data);
        
    }
}
?>
