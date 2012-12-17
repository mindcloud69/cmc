<?php if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');
class server_info
{
    public function mc_Usage()
    {
        //$command = 'ps -eo pid,comm,%cpu,%mem | sort -rk 3 | head';
        $command = 'ps -eo comm,%cpu,%mem | grep java';
        $javacount = 'ps -eo comm,%cpu,%mem | grep -c java';
        
        $return = substr(exec($command), -9);
        $info = explode('  ', $return);
                
        if (exec($javacount) > 1)
        {
         $info['MultiJavas']=TRUE;
        }
        else $info['MultiJavas']=FALSE;
        
        $info['cores'] = intval(exec('nproc'));
        
        return $info;
    }

    public function mc_Status($host){
        $socket = @fsockopen($host, 25565, $errno, $errstr);
   
        if ($socket === false){
            return false;
        }
   
        fwrite($socket, "\xfe\x01");
   
        $data = fread($socket, 256);
   
        if (substr($data, 0, 1) != "\xff"){
            return false;
        }
   
        if (substr($data, 3, 5) == "\x00\xa7\x00\x31\x00"){
            $data = explode("\x00", mb_convert_encoding(substr($data, 15), 'UTF-8', 'UCS-2'));
        }else{
            $data = explode('§', mb_convert_encoding(substr($data, 3), 'UTF-8', 'UCS-2'));
        }
   
        if (count($data) == 3){
            $info = array(
                'version'        => '1.3.2',
                'motd'            => $data[0],
                'players'        => intval($data[1]),
                'max_players'    => intval($data[2]),
            );
        }else{
            $info = array(
                'version'        => $data[0],
                'motd'            => $data[1],
                'players'        => intval($data[2]),
                'max_players'    => intval($data[3]),
            );
        }
   
        return $info;
    }
    
}
?>
