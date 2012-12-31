<?php

class install extends pf_controller
{
    public function index()
    {
        $data = new pf_json();
        $data->readJsonFile(pf_config::get('Json_Settings'));  //grab data from json
        $page_data = array('installed'=> $data->get('bukkit_dir')); //do we have a bukkit_dir?
        
        //if we have a settings file, we are installed and we check a login.
        if ($page_data['installed']) 
        {
        $this->checkLogin ();
        }
        $req = pf_config::get('requirements');
        $curver = (float)(substr(phpversion(), 0,3));
        
        $errors = array('type'=>'none');
        
        //check for screen
        $output = exec('screen -v');
        if ( (substr($output, 0,14)) !== 'Screen version') $errors['type']='screen';
                
        //check php version
        if ($curver < $req['PHP']) $errors['type']='php';
        
        
        //check read/write
        if (!file_put_contents(APPLICATION_DIR.'config/write-test-passed', 'testing')) $errors['type']='write';
        
        //if we have errors, we load the error page passing the type along with it
        if ($errors['type'] !== 'none')
        {
            
        $this->loadView('install/install_error_page.php',$errors);
        die();
        }
        
        
        
        //load install form
        $this->loadView('install/install_page.php',$page_data); //pass the array to the page
    }
    
    public function go()
    {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            pf_events::dispayFatal('Invalid Form Submission, Please Try Again');
        }
        
        //clean up the data really fast
        $adminname= trim($_POST['adminname']);
        $adminpass= trim($_POST['adminpass']);
        $bukkitdir= trim($_POST['bukkitdir']);
        
        //check to make sure we can write to where bukkit is installed
        if(file_put_contents($bukkitdir.'/CMCwritetest', 'writetest'))
        {
            unlink($bukkitdir.'/CMCwritetest');
        }
        else //if not we throw an error page in their face!
        {
            $errors = array('type'=>'bukkit-no-write');
            $this->loadView('install/install_error_page.php',$errors);
            die();
        }
        
        //check for old settings
        pf_events::eventsAdd('Checking for old settings file');
        if (file_exists(pf_config::get('Json_Settings')))
        {
            pf_events::eventsAdd('removing old settings file');
            if (!unlink(pf_config::get('Json_Settings')))
            {
                pf_events::eventsAdd('unable to delete old JSON settings file');
                pf_events::dispayFatal('Unable to Delete Old JSON Settings File!');
            }
        }
        //delete old database if there.
        if (file_exists(APPLICATION_DIR.'config'.DS.'CMC.db'))
        {
            unlink(APPLICATION_DIR.'config'.DS.'CMC.db');
        }
        
        //create new db object
        $sqlite = "sqlite:".APPLICATION_DIR.'config'.DS.'CMC.db';
        $db = new PDO($sqlite);

        //create new database table
        $sql = "CREATE TABLE IF NOT EXISTS Users (ID INTEGER PRIMARY KEY,User TEXT,Pass TEXT,Level TEXT)";
        $db->exec($sql);
        
        //generate a salt for the application
        $salt = "CMCSALT".time();
        
        //insert data
        $level = 'Admin';
        $adminpass = pf_auth::hashThis($adminpass, $salt);
        
        $statement = $db->prepare('INSERT INTO Users (User,Pass,Level) values(:User,:Pass,:Level)');
        $statement->bindParam(':User', $adminname);
        $statement->bindParam(':Pass', $adminpass);
        $statement->bindParam(':Level', $level);
        
        $statement->execute();
        
        //write settings for bukkit dir
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        $settings->set('bukkit_dir', $bukkitdir);
        $settings->set('salt',$salt);
        if (!$settings->writeJsonFile(pf_config::get('Json_Settings')))
        {
            pf_events::dispayFatal ('Unable to Save Config - Is /cmc/app/config writable?');

        }
        $this->loadView('install/complete_page.php');
        
    }
}
?>
