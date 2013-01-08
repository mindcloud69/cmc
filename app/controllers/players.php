<?php

class players extends pf_controller
{
    public function nope()
    {
        echo 'This is a work in progress,showing banned players, listing all players in the world, with the ability to delete them....also a list of ops i guess';
    }
    
    public function delete()
    {
        //make sure a file name is given
        if (!isset($_GET['name']))
        {
            pf_core::redirectUrl(MAIN_PAGE.'/players');
        }
        
        //append the extention
        $file = $_GET['name'].'.dat';
        
        //get the bukkit_dir
        $bukkit_dir = CMC::getCMCSetting('bukkit_dir');
        
        //get the world name
        mcController::getMCConfig(CMC::getCMCSetting('bukkit_dir').'/server.properties');
        $world = mcController::getSetting('level-name');
        
        $mainfile = $bukkit_dir."/".$world.'/players/'.$file;
        $nether = $bukkit_dir."/".$world.'_nether/players/'.$file;;
        $end = $bukkit_dir."/".$world.'_the_end/players/'.$file;
        
        //create the full path
        $files=array();
        $files[] = $mainfile;
        $files[]= $nether;
        $files[]= $end;
        
        foreach ($files as $filename)
        {
            if (file_exists($filename))
            {
            unlink($filename);
            }
        }
        
        pf_core::redirectUrl(MAIN_PAGE.'/players');
    }
    
    public function index()
    {
        //get our bukkit dir
        $data['bukkit_dir'] = CMC::getCMCSetting('bukkit_dir');
        

        //List Banned Players array
        $bannedfile = explode("\n",file_get_contents($data['bukkit_dir'].'/banned-players.txt'));
        $bannedlist=array();
        
        foreach ($bannedfile as $line)
        {
            //remove comments
            if (substr($line, 0,1) =="#")                continue;
            elseif (empty($line)) continue;
            else $bannedlist[]=  explode ('|', $line);
            
        }
        
        //list all banned players
        $banned=array();
        foreach ($bannedlist as $item)
        {
            $banned[]=array(
              'player'  =>  $item[0],
              'since'  =>  $item[1],
            );
        }
        
        //List Banned ips array
        $bannedipfile = explode("\n",file_get_contents($data['bukkit_dir'].'/banned-ips.txt'));
        $bannediplist=array();
        
        foreach ($bannedipfile as $line)
        {
            //remove comments
            if (substr($line, 0,1) =="#")                continue;
            elseif (empty($line)) continue;
            else $bannediplist[]=  explode ('|', $line);
            
        }
        
        //list all banned ips
        $bannedips=array();
        foreach ($bannediplist as $item)
        {
            $bannedips[]=array(
              'IP'  =>  $item[0],
              'since'  =>  $item[1],
            );
        }

        
        $opfile = explode("\n",file_get_contents($data['bukkit_dir'].'/ops.txt'));
        
        $oplist=array();
        foreach ($opfile as $name)
        {
            if ($name !== "") $oplist[]=$name;
        }
        
        
        //create data array
        $data = array();
        
        //banned users
        $data['banned']=$banned;
        
        //banned ips
        $data['bannedips']=$bannedips;
        
        //list all ops
        $data['ops']=$oplist;
        
        mcController::getMCConfig(CMC::getCMCSetting('bukkit_dir').'/server.properties');
        $world = mcController::getSetting('level-name');
        
        $data['players']=  mcController::displayPlayers(CMC::getCMCSetting('bukkit_dir')."/".$world);
        $data['world']=$world;
        $this->loadView('players/main_page.php', $data);
    }
}

?>
