<?php

class server extends pf_controller
{
    public function index()
    {
        $this->checkLogin();
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['server'], 'Sorry, You do not have access to this page!');
        
        $this->loadView('server/main_page');
    }
    
    public function startstop()
    {
        $this->checkLogin();
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['server'], 'Sorry, You do not have access to this page!');
        
        $this->loadView('server/startstop_page');
    }
            
    //send a command to screen
    private function send($command)
    {
        $log = $command .' issued by '. pf_auth::getVar('user');
        
        
        ///a little sanitation
        $command = stripslashes($command);
        $command = strip_tags($command);
        
        CMC::log($log);
        
        mcController::serverSend($command);
    }
    
    public function action()
    {
        $this->checkLogin();
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['server'], 'Sorry, You do not have access to this page!');
        
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
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['server'], 'Sorry, You do not have access to this page!');
        
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
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['server'], 'Sorry, You do not have access to this page!');
        
        //log it
        CMC::log('Server Stopped By '.pf_auth::getVar('user'));
        
        //removes our cronjob if it's there 
        CMC::removeCronJob('http://localhost/index.php/server/restart');//remove anything that calls the restart
        
        
        CMC::writeCMCSetting('restart_check', false); //turn off the restart check as the stop command will remove the cron.
        
        //executes the stop script
        exec('nohup /usr/bin/php '.APPLICATION_DIR.'mcscripts'.DS.'stop.php'."> /dev/null 2>/dev/null &");
        pf_core::redirectUrl(pf_config::get('main_page'));
    }
    
    //restarts the server if not online. No login check required
    public function restart()
    {
        CMC::log('Restart Cron - Checking Server Connectable');

        //check if server is online
        if (mcController::checkOnline())
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
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        
        //lock to user level
        pf_auth::lockPage($userlevels['server'], 'Sorry, You do not have access to this page!');
        
        //turn off the restart check because we are going to stop the server
        CMC::writeCMCSetting('restart_check', false); //turn off the restart check as the stop command will remove the cron.

        
        //get some settings
        $channel = CMC::getCMCSetting('update_channel');
        $custom_url = CMC::getCMCSetting('custom_url');
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        $jarfile = CMC::getCMCSetting('jarfile');
        
        //get the url for the download
        if (pf_core::compareStrings($channel, 'bukkit rc')) $url = 'http://dl.bukkit.org/latest-rb/craftbukkit.jar';
        elseif (pf_core::compareStrings($channel, 'bukkit beta')) $url = 'http://dl.bukkit.org/latest-beta/craftbukkit.jar';
        elseif (pf_core::compareStrings($channel, 'bukkit dev')) $url = 'http://dl.bukkit.org/latest-dev/craftbukkit.jar';
        elseif (pf_core::compareStrings($channel, 'vanilla')) $url = 'https://s3.amazonaws.com/MinecraftDownload/launcher/minecraft_server.jar';
            
        //did they setup a custom url? if so we need to use that
        //making sure it's not '' and the channel is set to custom.
        if ( ($custom_url !='') && (pf_core::compareStrings($channel, 'custom')) )
        {
            $url = $custom_url;
        }
        
        $data = array('channel'=>$channel,'url'=>$url,'bukkit_dir',$bukkit_dir);

        //if they wanna go, we do the updater, if not, we show the page :)
        if (!empty($_GET['go']))
        {
            
        //launch the updater
        require_once(APPLICATION_DIR.'/mcscripts/update.php');
            
        }
        else
        {
        $this->loadView('updater/updater_page.php',$data);
        }
    }


    //start the server
    public function startup()
    {
        $this->checkLogin();
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['server'], 'Sorry, You do not have access to this page!');
        
        //grab some settings
        $data= CMC::getCMCSetting('startup_ram');
        $restart_time = CMC::getCMCSetting('restart_check');
        $jar = CMC::getCMCSetting('jarfile');
        
        //make sure the .jar ends in .jar if not we add the .jar on to it
        if (!pf_core::compareStrings(substr($jar,-4), '.jar'))
        {
            $jar.='.jar';
        }
                
        
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
                //echo 'cronstarted';
                $times = '*/'.$restart_time.' * * * *';
                CMC::createCronJob($times, '/usr/bin/wget -q -O /tmp/cmc-crash-detect http://localhost/index.php/server/restart');
            }

            //save ram and restart settings to the settings file for later
            CMC::writeCMCSetting('startup_ram', $ram);
            CMC::writeCMCSetting('restart_cron',$restart);
            
            //get the bukkit_dir
            $dir = CMC::getCMCSetting('bukkit_dir');
            
            //write the script to the mcscripts folder
            $file = "cd $dir \n";
            $file .= 'screen -dmS bukkit java -Xincgc -Xmx'.$ram.'M -jar ' . $jar . "\n";
            
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
