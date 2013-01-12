<!DOCTYPE html>
<html>	
	<head>
		<?php pf_core::loadTemplate('header'); ?>
	</head>
        
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
                                    
                <div class="row">
                    <h3 class="center">Update Bukkit</h3>
                    <div class="six columns centered">
                        <p class="info twelve">
                        You are downloading an update for <?php echo $data['channel'];?><br />
                        
                        <?php
                        if ($data['channel'] == 'Custom')
                        {
                        echo 'You will be downloading it from this URL:<br />' .$data['url']. '<br />';
                        }
                        ?>
                        <br />
                        These can take some time, and WILL SHUTDOWN your server to do the update. 
                        These Normally take 5 minutes or more. 
                        Navigating away from the download page will cause the update to stop
                        
                        </p>
                        <div class="eight columns centered"><a class="button success twelve columns centered rounded" href="<?php echo MAIN_PAGE .'/server/update?go=true'?>">Yea, Yea, Let's Do This!</a></div>
                    </div>
                 </div>
        
            <?php pf_core::loadTemplate('footer'); ?>
	</body>
</html>