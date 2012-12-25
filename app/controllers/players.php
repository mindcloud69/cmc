<?php

class players extends pf_controller
{
    public function index()
    {
        echo 'work in progress';
    }
    
    public function banned()
    {
        //shows banned players
        $settings = new pf_json();
        $settings->readJsonFile(pf_config::get('Json_Settings'));
        
        $data['bukkit_dir'] = $settings->get('bukkit_dir');
        
        $bannedfile = explode("\n",file_get_contents($data['bukkit_dir'].'/banned-players.txt'));
        
        $bannedlist=array();
        
        foreach ($bannedfile as $line)
        {
            //remove comments
            if (substr($line, 0,1) =="#")                continue;
            elseif (empty($line)) continue;
            else $bannedlist[]=  explode ('|', $line);
            
        }
        $data=array();
        
        foreach ($bannedlist as $item)
        {
            $data[]=array(
              'player'  =>  $item[0],
              'since'  =>  $item[1],
            );
        }
        $this->loadView('players/banned.php', $data);
        
    }
}

?>
