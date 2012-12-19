<?php

class scripts extends pf_controller
{
    public function index()
    {
        $this->checkLogin();
        
        $this->loadView('scripts/main_page');
    }
    
    public function startup()
    {
        $this->checkLogin();
        
        //load the server config library
        $this->loadLibrary('server_conf');
        
        //get settings
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        $data = $settings->get('startup_script');
        
        //check if server is online
        if (server_conf::checkOnline())
        {
            //we are online
            pf_events::dispayFatal('Server Already Running, Perhaps you should stop it first?');
        }
        
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {
            //simple error checking
            /*
            if ($_POST['maxram'] <= $_POST['startram'])
            {
                pf_events::dispayFatal('Max Memory MUST BE equal or larger to Startup Memory');
            }
            */
            $startup = array(
                'Startram'  =>  $_POST['startram'],
                'Maxram'  =>  $_POST['maxram'],
            );
            
            $settings->set('startup_script', $startup);
            
            $settings->writeJsonFile(pf_config::get('Json_Settings'));
            
            $dir = $settings->get('bukkit_dir');
            
            $command = 'screen -S bukkitserver -d -m java -Xincgc -Xmx'.$_POST['maxram'].'M -jar '.$dir.'/craftbukkit.jar';
            exec($command);
        
            $this->loadView('scripts/start_complete_page',$data);
        }
        
        else 
        {
            $this->loadView('scripts/start_page',$data);
        }
        
    }

}
?>
