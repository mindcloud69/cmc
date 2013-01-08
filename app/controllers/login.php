<?php

class login extends pf_controller
{
    public function index()
    {
        if (isset($_GET['failed'])) $data = array('failed' => TRUE);
        else $data = array();
        $this->loadView('login/login_page.php',$data);
    }
    public function action()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        if ($_SERVER['REQUEST_METHOD']=="POST")
        {
            //get our salt
            $salt=CMC::getCMCSetting('salt');
            
            $username = $_POST['username'];
            $password = pf_auth::hashThis($_POST['password'], $salt);
    
            $loginaccepted=false;

            $sqlite = "sqlite:".DB_FILE;
            $db = new PDO($sqlite) or die('unable to use SQLite');
            
            //get all users
            $results= $db->query('SELECT * FROM Users');
            
            //loop through checking user/pass
            foreach ($results as $user)
            {
                if ( ($user['User'] == $username) && ($user['Pass'] == $password) )
                {
                    // don't forget $user['Level']
                    $loginaccepted=true;
                    $level = $user['Level'];
                    break;
                }
            }
            
        if ($loginaccepted)
        {
            pf_auth::setLoggedin();
            pf_auth::saveVar('user', $username);
            pf_auth::setUserLevel($level);
            pf_core::redirectUrl(pf_config::get('main_page'));
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
