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
        
        //get settings
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        $data = $settings->get('startup_script');
        
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {
            //simple error checking
            
            if ($_POST['maxram'] <= $_POST['startram'])
            {
                pf_events::dispayFatal('Max Memory MUST BE equal or larger to Startup Memory');
            }
            
            $startup = array(
                'Startram'  =>  $_POST['startram'],
                'Maxram'  =>  $_POST['maxram'],
            );
            
            $settings->set('startup_script', $startup);
            
            $settings->writeJsonFile(pf_config::get('Json_Settings'));
        
            $this->loadView('scripts/start_complete_page',$data);
        }
        
        else 
        {
            $this->loadView('scripts/start_page',$data);
        }
        
    }

}
?>
