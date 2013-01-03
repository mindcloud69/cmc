<?php

class settings extends pf_controller
{
    
    public function index()
    {
        $this->checkLogin();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $settings = new pf_json();
            $settings->readJsonFile(pf_config::get('Json_Settings'));
            
            $settings->set('bukkit_dir', $_POST['bukkit_dir']);
            $settings->set('bukkit_channel', $_POST['bukkit_channel']);
            $settings->set('log_lines', $_POST['log_lines']);
            $settings->set('restart_check', $_POST['auto_restart']);
            
            $settings->writeJsonFile(pf_config::get('Json_Settings'));
            
            $this->loadView('settings/settings_saved_page.php');
        }
        else
        {
            $settings = new pf_json();
            $settings->readJsonFile(pf_config::get('Json_Settings'));

            $data = array();

            $data['bukkit_dir'] = $settings->get('bukkit_dir');
            $data['bukkit_channel'] = $settings->get('bukkit_channel');
            $data['log_lines'] = $settings->get('log_lines');
            $data['restart_check'] = $settings->get('restart_check');

            $this->loadView('settings/settings_page.php',$data);
        }
    }
}
?>
