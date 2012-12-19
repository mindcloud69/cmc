<?php

class users extends pf_controller
{
    public function index()
    {
        $this->checkLogin();
        
        $sqlite = "sqlite:".APPLICATION_DIR.'config'.DS.'CMC.db';
        $db = new db($sqlite);
        
        //grab our users
        $results= $db->select('Users');
        
        //load the page and pass data
        $this->loadView('users/all_users_page.php',$results);
    }
    
    public function add()
    {
        $this->checkLogin();
        
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {
            
        //get the data
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        $sqlite = "sqlite:".APPLICATION_DIR.'config'.DS.'CMC.db';
        $db = new db($sqlite);
        
        if($db->select('Users', 'User = '.$username))
        {
            pf_events::dispayFatal('Username Already Taken, Try Again!');
        }    
        
        $insert = array(
            'User'  =>  $username,
            'Pass'  =>  $password,
            'Level' =>  'User'
        );
        
        $db->insert('Users', $insert);
        
        pf_core::redirectUrl(pf_config::get('main_page').'/users');
        }
        
        else $this->loadView('users/add_users_page.php');
    }
    public function delete()
    {
        $this->checkLogin();
        
        if (isset($_GET['id'])==false)
        {
            pf_events::dispayFatal('Invalide ID Specified');
        }
        
        $sqlite = "sqlite:".APPLICATION_DIR.'config'.DS.'CMC.db';
        $db = new db($sqlite);
        $db->delete('Users', 'ID = '.$_GET['id']);
        pf_core::redirectUrl(pf_config::get('main_page').'/users');
    }
}
?>
