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
        //load the server config library
        $this->loadLibrary('server_conf');
        
        //logging to server
        $this->loadLibrary('log_server');
        log_server::log($command . " issued by User");
        
        $command = "screen -S bukkit -p 0 -X stuff '".$command."\n' ";
        exec($command);
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
        
        $this->loadLibrary('server_control');
        
        server_control::log('Server Stopped By User');
        
        //removes our cronjob if it's there
        server_control::removeCronJob('/usr/bin/wget -q http://localhost/index.php/server/restart');
        
        //executes the stop script
        exec('nohup /usr/bin/php '.APPLICATION_DIR.'mcscripts'.DS.'stop.php'."> /dev/null 2>/dev/null &");
        pf_core::redirectUrl(pf_config::get('main_page'));
    }
    
    //restarts the server if not online. No login check required
    public function restart()
    {
        $this->loadLibrary('server_conf');
        
        server_control::log('Restart Cron - Checking Server Connectable');
        //check if server is online
        if (server_conf::checkOnline())
        {
            //we are online
            die('Server Already Online');
        }
        
        server_control::log('Restart Cron - Server Down - Starting New Server!');
        //if not online, we load it up
        if (file_exists(APPLICATION_DIR.'mcscripts'.DS.'startup.sh'))
        {
            exec(APPLICATION_DIR.'mcscripts'.DS.'startup.sh');
        }
        else die('No Startup Script Found');
    }
    
    //start the server
    public function startup()
    {
        $this->checkLogin();
        
        //load the server config library
        $this->loadLibrary('server_conf');
        $this->loadLibrary('server_control');
        
        //get settings
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        $data = $settings->get('startup_ram');
        
        //check if server is online
        if (server_conf::checkOnline())
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
                server_control::createCronJob('*/10 * * * *', '/usr/bin/wget -q http://localhost/index.php/server/restart');
            }

            //save ram and restart settings to the settings file for later
            $settings->set('startup_ram', $ram);
            $settings->set('restart_cron',$restart);
            
            //write the settings file
            $settings->writeJsonFile(pf_config::get('Json_Settings'));
            
            //get the bukkit_dir
            $dir = server_control::getBukkitDir();
            
            //write the script to the mcscripts folder
            $file = 'cd '.$dir."\n";
            $file .= 'screen -dmS bukkit java -Xincgc -Xmx'.$ram.'M -jar craftbukkit.jar'."\n";
            
            //if we can't write, we throw an error
            if (! file_put_contents(APPLICATION_DIR.'mcscripts'.DS.'startup.sh', $file))
            {
                pf_events::dispayFatal('Unable to save script! Is app/mcscripts writable?');
            }
            
            $chmod = 'chmod +x ' . APPLICATION_DIR.'mcscripts'.DS.'startup.sh';
            exec($chmod);
            
            //executes our new startup script
            server_control::log('Server Started By User');
            exec(APPLICATION_DIR.'mcscripts'.DS.'startup.sh');
            
            pf_core::redirectUrl(pf_config::get('main_page'));
        }
        
        else 
        {
            $this->loadView('server/start_page',$data);
        }
        
    }

}
?>
