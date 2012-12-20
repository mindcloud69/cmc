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
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        
        $bukkit_dir = $settings->get('bukkit_dir');
        //tac reverse reads a file | grep -v removes any connections from localhost | head -75 displays the top 75 entries (which is actally the last 75)
        $command = 'tac '.$bukkit_dir.DS.'server.log | grep -v 127.0.0.1 | grep -v /login | head -75';
        //put output in to array
        exec($command,$output);

        foreach ($output as $line)
        {
            //any warnings or severe logged actions, we highlight red.
            if ( (preg_match('/WARNING/', $line)) || (preg_match('/SEVERE/', $line)) )
                    $line = '<span class=warning>'.$line."</span>";
            echo $line."\n";
        }
    }
}
?>
