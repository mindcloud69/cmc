<?php

class settings extends pf_controller
{
    
    public function index()
    {
        $this->checkLogin();
        
        //write the new settings
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            CMC::writeCMCSetting('bukkit_dir', $_POST['bukkit_dir']);
            CMC::writeCMCSetting('bukkit_channel', $_POST['bukkit_channel']);
            CMC::writeCMCSetting('log_lines', $_POST['log_lines']);
            CMC::writeCMCSetting('restart_check', $_POST['auto_restart']);
            
            $this->loadView('settings/settings_saved_page.php');
        }
        //get the old settings and display them
        else
        {
            $data = array();
            $data['bukkit_dir'] = CMC::getCMCSetting('bukkit_dir');
            $data['bukkit_channel'] = CMC::getCMCSetting('bukkit_channel');
            $data['log_lines'] = CMC::getCMCSetting('log_lines');
            $data['restart_check'] = CMC::getCMCSetting('restart_check');

            $this->loadView('settings/settings_page.php',$data);
        }
    }
}
?>
