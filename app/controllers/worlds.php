<?php

class worlds extends pf_controller
{
    public function index()
    {
        $this->checkLogin();
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['worlds'], 'Sorry, You do not have access to this page!');
        
        //list worlds
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        
        //get all directories
        $dirs = array_filter(glob($bukkit_dir.'/*'),'is_dir');
        
        //holder for directories
        $worlds = array();
        
        //check each subdir for level.dat
        foreach ($dirs as $dir)
        {
            //check for a level.dat
            if (file_exists($dir .'/uid.dat'))
            {
                $worlds[]=$dir;
            //echo $dir .' is a world directory!';
            }
        }
        
        $this->loadView('worlds/main_page.php',$worlds);
    }
    
    public function delete()
    {
        $this->checkLogin();
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['worlds'], 'Sorry, You do not have access to this page!');
        
        
        //get our dir and last backup
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        
        //get our config
        mcController::getMCConfig($bukkit_dir.DS.'server.properties');
        
        //our current level
        $current_level = mcController::getSetting('level-name');
        
        //did we call this via URL?
        if (isset($_GET['level']))
        {
            $level = $_GET['level'];
            
            $pos = strpos($level, $current_level);
            
            //if we are running that level, and server is online
            if ( ($pos !==false) && (mcController::checkOnline()) )
            {
                echo 'That Level is currently being used!';
            }
            else
            {
                exec("rm -rf " . $bukkit_dir . DS .$level);
                $this->loadView('worlds/delete_page.php',$level);
            }
        }
            
    }
}

?>
