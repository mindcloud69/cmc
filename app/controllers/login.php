<?php

class login extends pf_controller
{
    public function index()
    {
        $this->loadView('login/login_page.php');
    }
    public function action()
    {
        if ($_SERVER['REQUEST_METHOD']=="POST")
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $loginaccepted=false;

            $sqlite = "sqlite:".APPLICATION_DIR.'config'.DS.'CMC.db';
            $db = new db($sqlite);
            
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
            pf_core::redirectUrl('index', 3);
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
