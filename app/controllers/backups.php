<?php

class backups extends pf_controller
{
    public function index()
    {
        $this->checkLogin();
        
        //get our dir and last backup
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        $bukkit_dir = $settings->get('bukkit_dir');
        $last_backup = $settings->get('last_backup');
        
        //get our config
        $this->loadLibrary('server_conf');
        server_conf::grabConfig($bukkit_dir.DS.'server.properties');
        
        $level = server_conf::getSetting('level-name');
        
        //all world directories in an array
        $data=array();
        $data[]=$bukkit_dir.DS.$level;
        if (is_dir($bukkit_dir.DS.$level."_nether")) $data[] = $bukkit_dir.DS.$level."_nether";
        if (is_dir($bukkit_dir.DS.$level."_the_end")) $data[] = $bukkit_dir.DS.$level."_the_end";
        
        //our last backup in the array
        $data['last_backup']=$last_backup;
        
        //load the view
        $this->loadView('backups/main_page.php',$data);
    }
    
    public function view()
    {
        $this->checkLogin();
        
        //get our dir and last backup
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        $bukkit_dir = $settings->get('bukkit_dir');
        
        $backup_dir = $bukkit_dir.DS.'CMC_backups'.DS;
        $files = glob($backup_dir."*.tar*");
        $data['backups']=$files;
        
        $this->loadView('backups/list_backups_page.php',$data);
    }
    
    public function delete()
    {
       $this->checkLogin();
       
       if (empty($_GET['file']))
       {
           pf_core::redirectUrl(pf_config::get('main_page').'/backups');
       }
       $file = $_GET['file'];
       
       //get our dir
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        $bukkit_dir = $settings->get('bukkit_dir');
        
        //if the file is in the bukkit dir we assume it's safe
        if (pf_core::compareStrings(substr($file, 0, strlen($bukkit_dir)),$bukkit_dir))
        {
            if (unlink($file))
            {
                $data = array($file);
                $this->loadView('backups/delete_page.php',$data);
            }
            else
            {
                pf_events::dispayFatal('Unable To Delete: '.$file);
            }
        }
    }
            
    
    public function action()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            pf_core::redirectUrl(pf_config::get('main_page'));
        }

        //get our dir
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        $bukkit_dir = $settings->get('bukkit_dir');
        
        $backup_dir = $bukkit_dir.DS.'CMC_backups';
        
        //check for the backup dir, if it doesn't exist, we make it
        if (!is_dir($backup_dir))
        {
            mkdir($backup_dir);
        }

        //send the save off command
        $this->send("save-off");
        $this->send('save-all');
        sleep(5);
        
        foreach ($_POST as $dir)
        {
            $name = explode('/', $dir);
            
            //for each dir, back it up
            if (is_dir($dir))
            {
                //$script .= 'tar -zcvf ' . $dir . ' ' . $backup_dir.DS.$name[2]."\n";
                $command = 'tar -zcf ' . $backup_dir.DS.$name[2] . "-".date('m-d-y-Gis').'.tar.gz ' . $dir."\n";
                exec('nohup '.$command."> /dev/null 2>/dev/null &");
            }
            
        }
        
        //turn back on save.
        $this->send('save-on');
        
        //record the last backup
        $settings->set('last_backup', date('m/d/Y'));
        
        //write the file
        if (!$settings->writeJsonFile(APPLICATION_DIR.'config'.DS.'settings.json'))
        {
            pf_html::clearPreviousBuffer();
            pf_events::dispayFatal('Unable to save settings! Is app/config writeable?');
        }
        
        $this->loadView('/backups/backup_complete_page.php');
        
    }
    
    //sends a command to the server
    private function send($command)
    {
        $command = "screen -S bukkit -p 0 -X stuff '".$command."\n' ";
        exec($command);
    }
}
?>
