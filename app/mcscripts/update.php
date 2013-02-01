<?php
ob_start();

    //flushes content
    function myFlush() {
        //echo(str_repeat(' ', 256));
        if (@ob_get_contents()) {
            @ob_end_flush();
        }
        flush();
    }
    
    function download_remote($url , $save_path)
    {
        echo 'Starting Download of '. $url .' . . . ';
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
                echo ". ";
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
                    <h1 class="center">Update Server Jar</h1>
                    <h5 class="info">Depending on your download speed, this might take awhile...</h5>
                    <div id="downloading" class="ten columns centered panel">
                        <?php
                        mcController::serverSend('Starting Server Update - Prepare to log off');
                        
                        download_remote($url, '/tmp/updated-server.jar');
                        
                        //announce we are stopping in 30 seconds
                        mcController::serverSend('say ###Stopping Server In 30 Seconds###');
                        echo 'Giving Everyone 30 seconds to disconnect<br />';
                        myFlush();
                        sleep(30);
                        
                        //announce we are stopping in 10 seconds
                        mcController::serverSend('say ###Stopping Server In 10 Seconds###');
                        echo 'Giving Everyone 10 seconds to disconnect<br />';
                        myFlush();
                        sleep(5);
                        
                        //announce we are stopping in 5 seconds
                        mcController::serverSend('say ###Stopping Server In 5 Seconds###');
                        echo 'Giving Everyone 5 seconds to disconnect<br />';
                        myFlush();
                        
                        //save all data to disk
                        mcController::serverSend('save-all');
                        sleep(5);
                        echo 'Stopping Server and waiting 20 seconds<br />';
                        myFlush();
                        
                        //stop the server
                        mcController::serverSend('stop');
                        sleep(20);
                        echo 'Server Stopped...<br />';
                        
                        
                        //move the file
                        echo 'Renaming '. $jarfile. ' to ' . substr($jarfile, 0,-3) . '.old...<br />';
                        rename($bukkit_dir.'/'.$jarfile, $bukkit_dir.'/'.substr($jarfile, 0,-3).'.old');
                        
                        echo 'Copying over new jarfile: '.$jarfile.'<br />';
                        rename('/tmp/updated-server.jar', $bukkit_dir.'/'.$jarfile);
                        
                        //make it executable
                        exec('chmod +x '.$bukkit_dir .DS.$jarfile);
                        
                        echo "Update Complete.... Go Start Your Server<br />";
                        CMC::log('Update Complete!')
                        ?>
                    </div>
                 </div>
             </div>
        
            <?php pf_core::loadTemplate("footer"); ?>
	</body>
</html>