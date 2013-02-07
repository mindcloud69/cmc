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
        
        $data['online']=  mcController::checkOnline();
        
        $info = mcController::CPUUsage();
        $data['CPU']=round($info[0],2);
        $data['MEM']=round($info[1],2);
        $data['MULTI']=$info['MultiJavas'];
        $data['CORES']=$info['cores'];
        pf_html::clearPreviousBuffer();
        echo json_encode($data);
    }
    
    public function info()
    {
        error_reporting(E_ALL);
        $info=  mcController::serverStatus('127.0.0.1');
        echo json_encode($info);
    }
    
    private function cleanlog()
    {
        //cleans all our 127.0.0.1 connection attempts
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        $command = "sed --in-place '/127.0.0.1/d' ".$bukkit_dir . DS .'server.log';
        exec($command);
    }
    
    public function clearlog()
    {
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        $command = "echo '' > ".$bukkit_dir . DS . 'server.log';
        exec($command);
        CMC::log('Log Cleared By '. pf_auth::getVar('user'));
        pf_core::redirectUrl(MAIN_PAGE.'/server');
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
    
    public function cmclog()
    {
        echo $this->parselog('cmc');
    }
    
    private function parselog($type=null)
    {
        //clean the log of 127.0.0.1 connection attempts
        $this->cleanlog();
        
        //log types
        $mainlog = '';
        $errorlog = '';
        $chatlog = '';
        $conlog = '';
        $cmclog = '';
        
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        $log_limit = CMC::getCMCSetting('log_lines');
        
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
                $cmclog .=$line."\n";
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
        if ($type == 'cmc') return $cmclog;
        else return $mainlog;
    }
}
?>
