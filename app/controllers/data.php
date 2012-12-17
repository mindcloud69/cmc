<?php

/*
 * This page will handle getting all data from the server and act as our main
 * "model" to get / store data
 */

class data extends pf_controller
{
    public function general()
    {
        $data = array();
        if ($this->loadLibrary('server_conf.php'))
        {
        $data['online']=server_conf::checkOnline();
        }
        
        if ($this->loadLibrary('server_info.php'))
        {
            $server = new server_info;
            $info = $server->mc_Usage();
            $data['CPU']=round($info[0],2);
            $data['MEM']=round($info[1],2);
            $data['MULTI']=$info['MultiJavas'];
            $data['CORES']=$info['cores'];
        }
        pf_html::clearPreviousBuffer();
        echo json_encode($data);
    }
    
    public function info()
    {
        error_reporting(E_ALL);
        //pf_html::clearPreviousBuffer();
        $this->loadLibrary('server_info.php');
        $server = new server_info;
        $info = $server->mc_Status('127.0.0.1');
        echo json_encode($info);
    }
    
    public function log()
    {
        //grab the servers config
        $data = array();
        $settings = new pf_json();
        $settings->readJsonFile(APPLICATION_DIR.'config'.DS.'settings.json');
        
        $bukkit_dir = $settings->get('bukkit_dir');
        
        $log = file_get_contents($bukkit_dir.DS.'server.log');
        $logarray = explode("\n",$log);
        
        foreach ($logarray as $line)
        {
            if (strpos($line, '127.0.0.1')) continue; //skip anything from ourselves
            echo $line."\n";
        }
    }
    
}
?>
