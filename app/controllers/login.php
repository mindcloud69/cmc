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

            //get the admin password
            $data = new pf_json();
            $data->readJsonFile(APPLICATION_DIR.'config'.DS.'settings.json');
            $admin = $data->get('admin_data');
            
            //get the users data
            $users = $data->get('users');
            
            //check if admin is logging in.
            if ( ($admin['admin_name'] == $username) && ($admin['admin_pass'] == $password) ) //@todo: all passwords need to be encoded to MD5 from the file and the form.
            {
                //we are admin - //we might do something different with this later
                $loginaccepted=true;
            }
            
            //check the credentials
            foreach ($users as $login)
            {
                if (( $username == $login['username']) && ($password == $login['password']))
                {
                    //we are a user
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
        pf_core::redirectUrl('');
    
    }
}
?>
