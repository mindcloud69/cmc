<?php

class scripts extends pf_controller
{
    
    public function start()
    {
        
        //get the server data
        $sqlite = "sqlite:".APPLICATION_DIR.'config'.DS.'CMC.db';
        $db = new db($sqlite);
        $results = $db->select('Startup');
        $data = $results;
        
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {
            $insert = array(
                'Startram'  =>  $_POST['startram'],
                'Maxram'  =>  $_POST['maxram'],
            );
        
            $db->insert('Startup', $insert);
            $this->loadView('scripts/start_complete_page');
        }
        
        else 
        {
            var_dump($data);
            $this->loadView('scripts/start_page',$data);
        }
        
    }

}
?>
