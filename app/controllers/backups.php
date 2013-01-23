<?php

class backups extends pf_controller
{
    public function index()
    {
        $this->checkLogin();
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['worlds'], 'Sorry, You do not have access to this page!');
        
        //get our dir and last backup
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        $last_backup = CMC::getCMCSetting('last_backup');
        
        //get our config
        mcController::getMCConfig($bukkit_dir.DS.'server.properties');
        
        //if we set the level name via URL...
        if (isset($_GET['level']))
        {
            $level = $_GET['level'];
        }
        else //we pull the current level
        {
        $level = mcController::getSetting('level-name');
        }
        
        //if _nether selected
        if (substr($level, -7)=='_nether')
        {
            $level = substr($level, 0,-7);
        }
        
        //if _the_end selected
        if (substr($level, -8)=='_the_end')
        {
            $level = substr($level, 0,-8);
        }
        
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
        pf_auth::lockPage($userlevels['worlds'], 'Sorry, You do not have access to this page!');
        
        //get our dir and last backup
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        
        $backup_dir = $bukkit_dir.DS.'CMC_backups'.DS;
        $files = glob($backup_dir."*.tar*");
        
        usort($files, create_function('$a,$b', 'return filemtime($b) - filemtime($a);'));
        
        $data['backups']=$files;
        
        
        if (empty($data['backups']))
        {
            $data['error']='No Backups Found!';
        }
        
        //if requesting a view
        if (isset($_GET['view']))
        {
            $view=$_GET['view'];
            $this->loadView('backups/view_backups_page.php',$data);
        }
        else $this->loadView('backups/list_backups_page.php',$data);
    }
    
    public function delete()
    {
        $this->checkLogin();
        
        $userlevels = CMC::getCMCSetting('pageaccess');
        //lock to user level
        pf_auth::lockPage($userlevels['worlds'], 'Sorry, You do not have access to this page!');
        
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

        foreach ($_POST as $dir)
        {
            //$name = explode('/', $dir);
            $name=end(explode("/",$dir));
            
            //backup each directory
            $this->doBackup($dir, $name);
        }
        
        //load the page
        $this->loadView('/backups/backup_complete_page.php');
        
    }
    
    public function schedule()
    {
        //if getting
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
        //get our bukkit dir
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        
        $data = array();
        $data['name']=$_GET['dir'];
        $data['dir']=$bukkit_dir."/".$_GET['dir'];
        $this->loadView('backups/schedule_page.php',$data);
        }
        
        //if submiting form
        elseif ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $command = $_POST['command'];
            $world = $_POST['world'];
            $hour = $_POST['hour'];
            $time = "0 $hour * * *";
            
            //remove the cronjob relating to this world
            CMC::removeCronJob($command);
            
            //create the cronjob
            CMC::createCronJob($time, $command);
            CMC::log('Scheduled Backup Created/Changed By User: '.pf_auth::getVar('user').' '. $world . ' will backedup daily at '. $hour .":00 hours");
            
            //get old scheduled backup array
            $schedules = array();
            $schedules = CMC::getCMCSetting('scheduled_backups');
            if (!$schedules)
            {
                //if never set a scheduled task
                $schedules = array();
            }
            //add entry for this world
            $schedules[$world]=$hour;
            CMC::writeCMCSetting('scheduled_backups', $schedules);
            
            pf_core::redirectUrl(MAIN_PAGE."/worlds");
        }
        
        //if no data, we redirect via mainpage
        else
        {
            pf_core::redirectUrl(MAIN_PAGE."/backups");
        }
        
    }
    
    public function scheduled()
    {
        if (!isset($_GET['dir']))
        {
            echo 'Directory Not Found!';
            die();
        }
        
        $dir = $_GET['dir'];
        
        if (isset($_GET['name']))
        {
        $name = $_GET['name'];
        }
        else $name = end(explode("/",$dir));
        
        //backup the directory
        $this->doBackup($dir, $name,true);
    }
    
    public function doBackup($dir,$name,$scheduled=null)
    {
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
        
        //for each dir, back it up
            if (is_dir($dir))
            {
                //if this is a scheduled backup, we log it one way.
                if ($scheduled)
                {
                    CMC::log('Scheduled Backup Started For World:'. $name);
                }
                else
                {
                    //log to server log the backup was started
                    CMC::log('Backup Started By User: '.pf_auth::getVar('user').' For World:'. $name);
                }
                
                $command = 'tar -zcf ' . $backup_dir.DS.$name . "-".date('m-d-y-Gis').'.tar.gz ' . $dir."\n";
                exec('nohup '.$command."> /dev/null 2>/dev/null &");
                
                //log backups complete for that world
                CMC::log('Backups Complete For World:'. $name);
            }
            
        //turn back on save.
        mcController::serverSend('save-on');
        
        //record the last backup
        CMC::writeCMCSetting('last_backup', date('m/d/Y'));
    }
    
    public function download()
    {
        if (isset($_GET['file']))
        {
            //get the filepath
            $filepath=$_GET['file'];
            
            $parts = explode('/', $filepath);
            $file = end($parts);
            //echo $file."<br />";
            //echo $filepath."<br />";
            //echo filesize($filepath)."<br />";
            //die();
            ob_clean();
            
            //create the download code
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file . '"'); 
            header("Content-length: " . filesize($filepath)); 
            header("Content-Transfer-Encoding: binary");
            readfile($filepath);
        }
        else 
        {
            echo '<meta http-equiv="refresh" content="3;url='.MAIN_PAGE.'/backups">';
            echo 'Unable to locate that file!';
        }
    }
}
?>
