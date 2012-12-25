<?php
    //restart our server

    send('say ###Stopping Server In 1 Minute###');
    sleep(50);
    send('say ###Stopping Server In 10 Seconds###');
    sleep(5);
    send('say ###Stopping Server In 5 Seconds###');
    send('save-all');
    sleep(5);
    send('stop');
    sleep(30);
    
    //force any zombie server to close
    exec ('pkill java'); //force all java's to close
    
    $dir = getcwd();
    exec('nohup '.$dir .'/app/mscripts/startup.sh'."> /dev/null 2>/dev/null &");
    
    
    function send($command)
    {
        $command = "screen -S bukkit -p 0 -X stuff '".$command."\n' ";
        exec($command);
    }
    
?>
