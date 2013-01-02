<?php

class settings extends pf_controller
{
    
    public function index()
    {
        $this->checkLogin();
        
        $this->loadView('settings/settings_page.php');
    }
}
?>
