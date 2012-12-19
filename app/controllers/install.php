<?php

class install extends pf_controller
{
    public function index()
    {
        $data = new pf_json();
        $data->readJsonFile(pf_config::get('Json_Settings'));  //grab data from json
        $page_data = array('installed'=> $data->get('bukkit_dir')); //do we have a bukkit_dir?
        
        if ($page_data['installed']) 
        {
        $this->checkLogin ();
        }
        
        $this->loadView('install/install_page.php',$page_data); //pass the array to the page
    }
    
    public function go()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            pf_events::dispayFatal('Invalid Form Submission, Please Try Again');
        }
        
        //clean up the data really fast
        $adminname= trim($_POST['adminname']);
        $adminpass= trim($_POST['adminpass']);
        $bukkitdir= trim($_POST['bukkitdir']);
        
        
        $sqlite = "sqlite:".APPLICATION_DIR.'config'.DS.'CMC.db';
        $db = new db($sqlite);
        
        //remove all users
        $db->exec('DELETE FROM USERS');
        
        
        $insert = array(
            'ID'    =>  1,
            'User'  =>  $adminname,
            'Pass'  =>  $adminpass,
            'Level' =>  'Admin'
        );
        
        //insert user data
        $db->insert('Users', $insert);
        
        //write settings for bukkit dir
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        $settings->set('bukkit_dir', $bukkitdir);
        if (!$settings->writeJsonFile(pf_config::get('Json_Settings')))
        {
            pf_events::dispayFatal ('Unable to Save Config - Is /cmc/app/config writable?');

        }
        
        $this->loadView('install/complete_page.php');
        
    }
}
?>
