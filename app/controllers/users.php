<?php

class users extends pf_controller
{
    public function index()
    {
        
        $sqlite = "sqlite:".APPLICATION_DIR.'config'.DS.'CMC.db';
        $db = new db($sqlite);
        
        //grab our users
        $results= $db->select('Users');
        
        //load the page and pass data
        $this->loadView('users/all_users_page.php',$results);
        
        
    }
    
}
?>
