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
    
    public function mainlog()
    {
        echo $this->parselog('main');
    }
    
    public function errorlog()
    {
        echo $this->parselog('error');
    }
    
    public function chatlog()
    {
        echo $this->parselog('chat');
    }
    
    public function connectionlog()
    {
        echo $this->parselog('connection');
    }
    
    private function parselog($type=null)
    {
        //log types
        $mainlog = '';
        $errorlog = '';
        $chatlog = '';
        $conlog = '';
        
        //grab the servers config
        $data = array();
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        
        $bukkit_dir = $settings->get('bukkit_dir');
        $log_limit = $settings->get('log_lines');
        
        //tac reverse reads a file | grep -v removes any connections from localhost | head -$log_limit displays the top ?? entries (which is actually the last as it's reversed)
        $command = 'tac '.$bukkit_dir.DS.'server.log | grep -v 127.0.0.1 | grep -v /login | head -'.$log_limit;
        //put output in to array
        exec($command,$output);

        foreach ($output as $line)
        {
            //terminal color codes
            $colorcodes=array('[31;1m','[37;1m','[m','[35;1m');
            
            //removes color codes from the line
            $line = str_replace($colorcodes, "", $line);
            
            //any warnings or severe logged actions, we highlight red.
            if ( (preg_match('/WARNING/', $line)) || (preg_match('/SEVERE/', $line)) )
            {
                $line = '<span class=serverwarning>'.$line."</span>";
                $errorlog .= $line."\n";
                
            }
            
            //any CMC Messages we Highlight Light Blue
            if (preg_match('[CMC]', $line))
            {
                $line = '<span style="color:#08c;">'.$line."</span>";
            }
            
            //look for chat
            if (strpos($line,' [INFO] <') !==false)
            {
                $chatlog .=$line."\n";
            }
            
            //look for connect/disconnect
            if ( (strpos($line,'disconnect.quitting') !==false) || (strpos($line,' logged in with entity id ') !==false) )
            {
                $conlog .=$line."\n";
            }
            
            
            //always log to the main log
            $mainlog .= $line."\n";
            
            
        }
        
        if ($type == 'error') return $errorlog;
        if ($type == 'chat') return $chatlog;
        if ($type == 'connection') return $conlog;
        else return $mainlog;
    }
}
?>
