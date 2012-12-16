<?php

class install extends pf_controller
{
    public function index()
    {
        $data = new pf_json();
        $data->readJsonFile(APPLICATION_DIR.'config'.DS.'settings.json');  //grab data from json
        $page_data = array('installed'=> $data->get('bukkit_dir')); //do we have a bukkit_dir?
        $this->loadView('install/install_page.php',$page_data); //pass the array to the page
    }
    
    public function go()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            pf_events::dispayFatal('Invalid Form Submission, Please Try Again');
        }
        $adminname=trim($_POST['adminname']);
        $adminpass=trim($_POST['adminpass']);
        $bukkitdir=trim($_POST['bukkitdir']);
        
        $admin=array();
        $admin['admin_name']=$adminname;
        $admin['admin_pass']=$adminpass;
        
        $data = new pf_json();
        $data->readJsonFile(APPLICATION_DIR.'config'.DS.'settings.json');
        $data->set('bukkit_dir', $bukkitdir);
        $data->set('admin_data', $admin);
        if ($data->writeJsonFile(APPLICATION_DIR.'config1'.DS.'settings.json'))
        {
            $this->loadView('install/complete_page.php');
        }
        else            pf_events::dispayFatal ('Unable to Save Config - Is /cmc/app/config writable?');
            
    }
}
?>
