<?php

class server extends pf_controller
{
    public function index()
    {
        $this->checkLogin();
        
        $this->loadView('server/main_page');
    }
    
    //send a command to screen
    private function send($command)
    {
        //load CMC library
        $this->loadLibrary('CMC');
        $this->loadLibrary('mcController');
        
        $log = $command .' issued by '. pf_auth::getVar('user');
        
        CMC::log($log);
        mcController::serverSend($command);
    }
    
    public function action()
    {
        $this->checkLogin();
        
        //if no action/command passed via url we load the main page again
        if ( (!isset($_GET['action'])) && (!isset($_GET['command'])) )
        {
            $this->loadView('server/action_page');
        }
        
        //we issue the actions / commands
        else 
        {
            //what did they want to say?
            $action = $_GET['action'];
            $command = $_GET['command'];

            $this->send($action . ' '.$command);
            
            pf_core::redirectUrl(pf_config::get('main_page'));
            
        }
    }
    
    //send a say command
    public function say()
    {
        $this->checkLogin();
        
        //if no command passed via url
        if (!isset($_GET['command']))
        {
            $this->loadView('server/say_page');
        }
        
        else 
        {
            //what did they want to say?
            $say = $_GET['command'];

            $this->send('say '.$say);
            
            pf_core::redirectUrl(pf_config::get('main_page'));
            
        }
    }
    
    //stop the server
    public function stop()
    {
        $this->checkLogin();
        
        //load CMC library
        $this->loadLibrary('CMC');
        $this->loadLibrary('mcController');
        
        //log it
        CMC::log('Server Stopped By '.pf_auth::getVar('user'));
        
        //removes our cronjob if it's there 
        CMC::removeCronJob('http://localhost/index.php/server/restart');//remove anything that calls the restart
        
        //executes the stop script
        exec('nohup /usr/bin/php '.APPLICATION_DIR.'mcscripts'.DS.'stop.php'."> /dev/null 2>/dev/null &");
        pf_core::redirectUrl(pf_config::get('main_page'));
    }
    
    //restarts the server if not online. No login check required
    public function restart()
    {
        //load CMC library
        $this->loadLibrary('CMC');
        $this->loadLibrary('mcController');
        
        CMC::log('Restart Cron - Checking Server Connectable');

        //check if server is online
        if (server_conf::checkOnline())
        {
            //we are online
            die('Server Already Online');
        }
        
        //if not online, we load it up
        CMC::log('Restart Cron - Server Down - Starting New Server!');
        exec(APPLICATION_DIR.'mcscripts'.DS.'startup.sh');
        pf_core::redirectUrl(pf_config::get('main_page'));
    }
    
    //updates bukkit based on on branch selected
    public function update()
    {
        $this->checkLogin();
        
        //load CMC library
        $this->loadLibrary('CMC');
        $this->loadLibrary('mcController');
        
        $channel = CMC::getCMCSetting('bukkit_channel');
        
        CMC::writeCMCSetting('restart_check', false); //turn off the restart check as the stop command will remove the cron.
                
        //get the url for the download
        if ($channel == 'Recommended') $url = 'http://dl.bukkit.org/latest-rb/craftbukkit.jar';
        elseif ($channel == 'Beta') $url = 'http://dl.bukkit.org/latest-beta/craftbukkit.jar';
        elseif ($channel == 'Dev') $url = 'http://dl.bukkit.org/latest-dev/craftbukkit.jar';
        
        //launch the updater
        require_once(APPLICATION_DIR.'/mcscripts/update.php');
    }


    //start the server
    public function startup()
    {
        $this->checkLogin();
        
        //load CMC library
        $this->loadLibrary('CMC');
        $this->loadLibrary('mcController');
        
        $data= CMC::getCMCSetting('startup_ram');
        $restart_time = CMC::getCMCSetting('restart_check');
        
        //check if server is online
        if (mcController::checkOnline())
        {
            //we are online
            pf_events::dispayFatal('Server Already Running, Perhaps you should stop it first?');
        }
        
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {
            $ram = $_POST['maxram'];
            $restart = $_POST['restart'];
            
            //if restart is checked, we create a cronjob to watch for server crashes and restart server.
            if (pf_core::compareStrings($restart, 'true'));
            {
                CMC::createCronJob('*/'.$restart_time.' * * * *', '/usr/bin/wget -q -O /tmp/cmc-crash-detect http://localhost/index.php/server/restart');
            }

            //save ram and restart settings to the settings file for later
            CMC::writeCMCSetting('startup_ram', $ram);
            CMC::writeCMCSetting('restart_cron',$restart);
            
            //get the bukkit_dir
            $dir = CMC::getCMCSetting('bukkit_dir');
            
            //write the script to the mcscripts folder
            $file = "cd $dir \n";
            $file .= 'screen -dmS bukkit java -Xincgc -Xmx'.$ram.'M -jar craftbukkit.jar'."\n";
            
            //if we can't write, we throw an error
            if (! file_put_contents(APPLICATION_DIR.'mcscripts'.DS.'startup.sh', $file))
            {
                pf_events::dispayFatal('Unable to save script! Is app/mcscripts writable?');
            }
            
            //change the file to executable
            $chmod = 'chmod +x ' . APPLICATION_DIR.'mcscripts'.DS.'startup.sh';
            exec($chmod);
            
            //executes our new startup script
            CMC::log('Server Started By '.pf_auth::getVar('user'));
            exec(APPLICATION_DIR.'mcscripts'.DS.'startup.sh');
            
            //redirect to main page
            pf_core::redirectUrl(pf_config::get('main_page'));
        }
        
        else 
        {
            $this->loadView('server/start_page',$data);
        }
        
    }

}
?>
