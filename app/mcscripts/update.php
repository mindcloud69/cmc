<?php
ob_start();
    function send($command)
    {
        $command = "screen -S bukkit -p 0 -X stuff '".$command."\n' ";
        exec($command);
    }
    
    function myFlush() {
        echo(str_repeat(' ', 256));
        if (@ob_get_contents()) {
            @ob_end_flush();
        }
        flush();
    }
    
    function formatBytes($size, $precision = 2)
    {
        $base = log($size) / log(1024);
        $suffixes = array('', 'k', 'M', 'G', 'T');   

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    }
    
    function download_remote($url , $save_path)
    {
        echo 'Starting Download...';
        $f = fopen( $save_path , 'w+');

        $handle = fopen($url , "rb");

        $i = 1;
        while (!feof($handle)) 
        {
            $i = ($i + (8*1024));
            $contents = fread($handle, 8*1024);
            fwrite($f , $contents);
            
            $seconds = date('s');
            if ($seconds %3 == 0)
            {
                echo ".";
                myFlush();
            }
            
        }

        fclose($handle);
        fclose($f);
        echo '<br />Download Complete<br />';
    }

?>


<!DOCTYPE html>
<html>	
	<head>
		<?php pf_core::loadTemplate('header'); ?>
	</head>
        
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
                                    
             <div class="container">
                <div class="row">
                    <h1 class="center">Update Bukkit</h1>
                    <div id="downloading" class="span10 offset1">
                        You are downloading the <?php echo $channel;?> branch of bukkit.<br />
                        <?php
                        download_remote($url, '/tmp/craftbukkit.jar');
                        
                        //shutdown the server
                        send('say ###Stopping Server In 30 Seconds###');
                        echo 'Giving Everyone 30 seconds to disconnect<br />';
                        myFlush();
                        sleep(30);
                        send('say ###Stopping Server In 10 Seconds###');
                        echo 'Giving Everyone 10 seconds to disconnect<br />';
                        myFlush();
                        sleep(5);
                        send('say ###Stopping Server In 5 Seconds###');
                        echo 'Giving Everyone 5 seconds to disconnect<br />';
                        myFlush();
                        send('save-all');
                        sleep(5);
                        echo 'Stopping Server and waiting 20 seconds<br />';
                        myFlush();
                        send('stop');
                        sleep(20);
                        
                        //move the file
                        rename($bukkit_dir.'/craftbukkit.jar', $bukkit_dir.'/craftbukkit.old');
                        rename('/tmp/craftbukkit.jar', $bukkit_dir.'/craftbukkit.jar');
                        
                        //make it executible
                        exec("chmod +x $bukkit_dir/craftbukkit.jar");
                        
                        echo "Update Complete.... Go Start Your Server and Pray<br />";
                        ?>
                    </div>
                 </div>
             </div>
        
            <?php pf_core::loadTemplate('footer'); ?>
	</body>
</html>