<?php

class login extends pf_controller
{
    public function index()
    {
        if (isset($_GET['failed'])) $data = array('failed' => TRUE);
        $this->loadView('login/login_page.php',$data);
    }
    public function action()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        if ($_SERVER['REQUEST_METHOD']=="POST")
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $loginaccepted=false;

            $sqlite = "sqlite:".APPLICATION_DIR.'config'.DS.'CMC.db';
            require_once(SYSTEM_DIR.'core'.DS.'db.php');
            $db = new db($sqlite) or die('unable to use SQLite');
            
            //get all users
            $results= $db->select('Users');
            
            //loop through checking user/pass
            foreach ($results as $user)
            {
                if ( ($user['User'] == $username) && ($user['Pass'] == $password) )
                {
                    // don't forget $user['Level']
                    $loginaccepted=true;
                    break;
                }
            }
            
        if ($loginaccepted)
        {
            pf_auth::setLoggedin();
            pf_auth::saveVar('user', $username);
            pf_core::redirectUrl('main/index');
        }
        else 
            {
            echo 'Invalid Login!';
            pf_core::redirectUrl(pf_config::get('main_page').'/login?failed=true');
            }
        }
    }
    public function logout()
    {
        pf_auth::loggout();
        pf_core::redirectUrl('');
    
    }
}
?>
