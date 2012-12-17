<?php

class server extends pf_controller

{
    
    public function index()
    {
        $data = array('bukkit_dir'=>$this->getdir());
        $this->loadLibrary('server_conf');
        server_conf::grabConfig($data['bukkit_dir'].DS.'server.properties');
        $data = server_conf::$server_data;
        $this->loadView('server/config_page.php',$data);
    }
    
    
    private function getdir()
    {
        $data = array();
        $settings = new pf_json();
        $settings->readJsonFile(APPLICATION_DIR.'config'.DS.'settings.json');
        
        $bukkit_dir = $settings->get('bukkit_dir');
        return $bukkit_dir;
    }
            
    
}
?>
