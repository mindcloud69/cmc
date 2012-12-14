<?php

class login
{
    public function index()
    {
        pf_core::loadTemplate('header');
        pf_core::loadTemplate('login');
    }
    public function action()
    {
        if ($_SERVER['REQUEST_METHOD']=="POST")
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $loginaccepted=false;

            //check the credentials
            foreach (pf_config::get('logins') as $login)
            {
                if (( $username == $login['username']) && ($password == $login['password']))
                {
                    $loginaccepted=true;
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
        pf_core::redirectUrl('index');
    
    }
}
?>
