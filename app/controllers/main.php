<?php

class main extends pf_controller
{
    public function index()
    {
        //check if logged in
        $this->checkLogin();
        
        $this->loadLibrary('server_conf');
        
        //grab the servers config
        $data = array();
        $settings = new pf_json();
        $settings->readJsonFile(APPLICATION_DIR.'config'.DS.'settings.json');
        
        $data['bukkit_dir'] = $settings->get('bukkit_dir');
        
        
        if (!server_conf::grabConfig($data['bukkit_dir'].'/server.properties'))
        {
            pf_core::redirectUrl('install');
        }
        
        //get some info from the config file
        $data['online']=server_conf::checkOnline();
        $data['world'] = server_conf::getSetting('level-name');
        $data['pvp'] = server_conf::getSetting('pvp');
        $data['difficulty'] = server_conf::getSetting('difficulty');
        $essentials = server_conf::checkEssentials($data['bukkit_dir']);

        $gamemode= server_conf::getSetting('gamemode');
        if ($gamemode == 0) $gamemode = 'Survival';
        elseif ($gamemode == 1) $gamemode = 'Creative';
        elseif ($gamemode == 1) $gamemode = 'Adventure';
        
        if ($essentials) $data['essentials']='TRUE';
        else $data['essentials'] = 'FALSE';
        
        $data['gamemode'] = $gamemode;
        
        $list = '';
        server_conf::checkPluggins($data['bukkit_dir']);
        foreach (server_conf::$pluggins as $plugin)
        {
            $list .= ", ".$plugin;
        }
        
        $data['pluggins']=$list;

        //load our main page
        $this->loadView('main_page',$data);
        
        
    }
}
?>
