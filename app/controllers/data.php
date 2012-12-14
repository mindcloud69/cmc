<?php

/*
 * This page will handle getting all data from the server and act as our main
 * "model" to get / store data
 */

class data extends pf_controller
{
    public function onlinestatus()
    {
        if ($this->loadLibrary('server_conf.php'))
        {
        if (server_conf::checkOnline()) echo 'Online';
        else echo "Offline";
        }
        
    }
}
?>
