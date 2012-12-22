<?php

class scripts extends pf_controller
{
    public function index()
    {
        $this->checkLogin();
        
        $this->loadView('scripts/main_page');
    }
    
    public function test()
    {
        exec('pwd',$return);
        var_dump($return);
    }
    
    public function say()
    {
        //if no command passed via url
        if (!isset($_GET['command']))
        {
            $this->loadView('scripts/say_page');
        }
        
        else 
        {
            //what did they want to say?
            $say = $_GET['command'];

            //write the script to the mcscripts folder
            $file = "screen -S bukkit -p 0 -X stuff $'say test\\n' ";
            //$file = 'screen -S bukkit -p 0 -X stuff "say '.$say. '$echo -ne \'r\'"'."\n";

            //if we can't write, we throw an error
            if (! file_put_contents(APPLICATION_DIR.'mcscripts'.DS.'say.sh', $file))
            {
                pf_events::dispayFatal('Unable to save script! Is app/mcscripts writable?');
            }

            $chmod = 'chmod +x ' . APPLICATION_DIR.'mcscripts'.DS.'say.sh';
            exec($chmod);

            exec(APPLICATION_DIR.'mcscripts'.DS.'say.sh');
            echo $file;
            //pf_core::redirectUrl(pf_config::get('main_page'));
        }
        
    }  
    
    public function restart()
    {
        $this->checkLogin();
        exec('nohup ' . APPLICATION_DIR.'mcscripts'.DS.'restart.sh');
        pf_core::redirectUrl(pf_config::get('main_page'));
    }


    public function stop()
    {
        $this->checkLogin();
        exec(APPLICATION_DIR.'mcscripts'.DS.'shutdown.sh');
        pf_core::redirectUrl(pf_config::get('main_page'));
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
            $startup = array(
                'Maxram'  =>  $_POST['maxram'],
            );
            
            //save this to the settings file for later
            $settings->set('startup_script', $startup);
            
            //write the settings file
            $settings->writeJsonFile(pf_config::get('Json_Settings'));
            
            //get the bukkit_dir
            $dir = $settings->get('bukkit_dir');
            
            //write the script to the mcscripts folder
            $file = 'cd '.$dir."\n";
            $file .= 'screen -dmS bukkit java -Xincgc -Xmx'.$_POST['maxram'].'M -jar craftbukkit.jar'."\n";
            
            //if we can't write, we throw an error
            if (! file_put_contents(APPLICATION_DIR.'mcscripts'.DS.'startup.sh', $file))
            {
                pf_events::dispayFatal('Unable to save script! Is app/mcscripts writable?');
            }
            
            $chmod = 'chmod +x ' . APPLICATION_DIR.'mcscripts'.DS.'startup.sh';
            exec($chmod);
            
            exec(APPLICATION_DIR.'mcscripts'.DS.'startup.sh');
            
            pf_core::redirectUrl(pf_config::get('main_page'));
        }
        
        else 
        {
            $this->loadView('scripts/start_page',$data);
        }
        
    }

}
?>
