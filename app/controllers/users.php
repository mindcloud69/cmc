<?php

class users extends pf_controller
{
    public function index()
    {
        $this->checkLogin();
        
        //load up the database
        
        $sqlite = "sqlite:".DB_FILE;
        $db = new PDO($sqlite);
        
        //grab our users
        $results= $db->query('SELECT * FROM Users');
        
        //close the DB
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
        $salt = CMC::getCMCSetting('salt');
        
        //salt our password
        $password=  pf_auth::hashThis($password, $salt);
        
        $sqlite = "sqlite:".DB_FILE;
        $db = new PDO($sqlite);
        
        $q = $db->prepare('INSERT INTO Users (User,Pass,Level) values(:User,:Pass,:Level)');
        $q->bindParam(':User', $username);
        $q->bindParam(':Pass', $password);
        $q->bindParam(':Level', $level);
        $q->execute();
        
        $this->loadLibrary('server_control');
        
        CMC::log('User Added: '.$username .' by User:' .pf_auth::getVar('user'));
        
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
        
        $sqlite = "sqlite:".DB_FILE;
        $db = new db($sqlite);
        $db->delete('Users', 'ID = '.$_GET['id']);
        
        $this->loadLibrary('server_control');
        
        CMC::log('User '.$_GET['user'].' Deleted by User:' .pf_auth::getVar('user'));
        
        pf_core::redirectUrl(pf_config::get('main_page').'/users');
    }
}
?>
