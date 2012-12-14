<?php

class main extends pf_controller
{
    public function index()
    {
        //check if logged in
        $this->checkLogin();
        
        $this->loadLibrary('server_conf');
        //grab the servers config
        if (!server_conf::grabConfig('/bukkit/server.properties')) //@todo:make dynamic from settings.json file
        {
            pf_events::dispayFatal('Server.properties Not Found!');
        }
        
        
        //load our main page
        $this->loadView('main_page');
        
    }
    
}
?>
