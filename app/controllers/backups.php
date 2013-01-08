<?php

class backups extends pf_controller
{
    public function index()
    {
        $this->checkLogin();
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['backup'], 'Sorry, You do not have access to this page!');
        
        //get our dir and last backup
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        $last_backup = CMC::getCMCSetting('last_backup');
        
        //get our config
        mcController::getMCConfig($bukkit_dir.DS.'server.properties');
        
        $level = mcController::getSetting('level-name');
        
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
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['backup'], 'Sorry, You do not have access to this page!');
        
        //get our dir and last backup
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        
        $backup_dir = $bukkit_dir.DS.'CMC_backups'.DS;
        $files = glob($backup_dir."*.tar*");
        $data['backups']=$files;
        
        
        if (empty($data['backups']))
        {
            $data['error']='No Backups Found!';
        }
        
        $this->loadView('backups/list_backups_page.php',$data);
    }
    
    public function delete()
    {
        $this->checkLogin();
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['backup'], 'Sorry, You do not have access to this page!');
        
        if ($_SERVER['REQUEST_METHOD'] !='POST')
        {
            pf_core::redirectUrl(pf_config::get('main_page').'/backups');
        }
        
        //get our bukkit dir
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        
        foreach ($_POST['file'] as $file)
        {
            //make sure in bukkit dir
            if (pf_core::compareStrings(substr($file, 0, strlen($bukkit_dir)),$bukkit_dir))
            {
                if (unlink($file)) //delete the file
                {
                    CMC::log('Backup '.$file .' Deleted By: '.pf_auth::getVar('user'));
                }
                else //can't delete, throw error
                {
                    pf_events::dispayFatal('Unable To Delete: '.$file);
                }
            }
        }
        $this->loadView('backups/delete_page.php');
    }


    public function action()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            pf_core::redirectUrl(pf_config::get('main_page'));
        }

        //get our bukkit dir
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        $backup_dir = $bukkit_dir.DS.'CMC_backups';
        
        //check for the backup dir, if it doesn't exist, we make it
        if (!is_dir($backup_dir))
        {
            mkdir($backup_dir);
        }

        //send the save off command
        mcController::serverSend('save-off');
        mcController::serverSend('save-all');
        sleep(5);
        
        foreach ($_POST as $dir)
        {
            $name = explode('/', $dir);
            
            //for each dir, back it up
            if (is_dir($dir))
            {
                //log to server log the backup was started
                CMC::log('Backup Started By User: '.pf_auth::getVar('user').' For World:'. $name[2]);
                $command = 'tar -zcf ' . $backup_dir.DS.$name[2] . "-".date('m-d-y-Gis').'.tar.gz ' . $dir."\n";
                exec('nohup '.$command."> /dev/null 2>/dev/null &");
                
                //log backups complete for that world
                CMC::log('Backups Complete For World:'. $name[2]);
            }
            
        }
        
        //turn back on save.
        mcController::serverSend('save-on');
        //$this->send('save-on');
        
        //record the last backup
        CMC::writeCMCSetting('last_backup', date('m/d/Y'));
        
        //load the page
        $this->loadView('/backups/backup_complete_page.php');
        
    }
}
?>
