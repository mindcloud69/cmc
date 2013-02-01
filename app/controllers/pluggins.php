<?php

class pluggins extends pf_controller
{
    public function index()
    {
        $this->checkLogin();
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['pluggins'], 'Sorry, You do not have access to this page!');
        
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        mcController::checkPluggins($bukkit_dir);
        $data=mcController::$pluggins;
        $this->loadView('plugins/main_page.php', $data);
    }
    
    public function delete()
    {
        $this->checkLogin();
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['pluggins'], 'Sorry, You do not have access to this page!');
        
        if (empty($_GET['file']))
        {
            pf_core::redirectUrl(MAIN_PAGE.'/pluggins');
        }
        
        //get the file from the get request
        $file = $_GET['file'];
        
        //get bukkit dir
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        
        //remove the directory for the pluggin
        if (is_dir($bukkit_dir . DS.'plugins'. DS . $file.DS))
        {
            $deldir = 'rm -Rf ' . $bukkit_dir . DS.'plugins'. DS . $file.DS;
            exec($deldir);
        }
        
        //remove the pluggin file
        if (file_exists($bukkit_dir . DS.'plugins'. DS . $file.'.jar'))
        {
            $delfile = 'rm -f ' . $bukkit_dir . DS.'plugins'. DS . $file . '.jar';
            exec($delfile);
        }
        pf_core::redirectUrl(MAIN_PAGE.'/pluggins');
        
    }
}
?>
