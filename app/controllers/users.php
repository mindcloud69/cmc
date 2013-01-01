<?php

class users extends pf_controller
{
    public function index()
    {
        $this->checkLogin();
        
        //load up the database
        $sqlite = "sqlite:".APPLICATION_DIR.'config'.DS.'CMC.db';
        $db = new PDO($sqlite);
        
        //grab our users
        $results= $db->query('SELECT * FROM Users');
        
        $db=null;
        
        $this->loadView('users/main_page.php',$results);
    }
    
    public function add()
    {
        $this->checkLogin();
        
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {
            
        //get the data
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $level = trim($_POST['level']);
        
        //get our salt
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        $salt = $settings->get('salt');
        
        //salt our password
        $password=  pf_auth::hashThis($password, $salt);
        
        $sqlite = "sqlite:".APPLICATION_DIR.'config'.DS.'CMC.db';
        $db = new PDO($sqlite);
        
        $q = $db->prepare('INSERT INTO Users (User,Pass,Level) values(:User,:Pass,:Level)');
        $q->bindParam(':User', $username);
        $q->bindParam(':Pass', $password);
        $q->bindParam(':Level', $level);
        $q->execute();
        
        $this->loadLibrary('log_server');
        
        log_server::log('User Added: '.$username);
        
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
        
        $this->loadLibrary('log_server');
        
        log_server::log('User Deleted: '.$username);
        
        pf_core::redirectUrl(pf_config::get('main_page').'/users');
    }
}
?>
