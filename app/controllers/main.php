<?php

class main
{
    public function index()
    {
        //check if logged in, if not redirect to /login
        pf_auth::checkLogin('login');
        //load our main page
        
        pf_core::loadPage('main');
    }
    
}
?>
