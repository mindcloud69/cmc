<?php
//Load errortype from array
$type = $data['type'];

$req = pf_config::get('requirements');

?>


<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
            <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">Install Error!</h3>
                        
            <div class="container">
                <div class="row">
                    
                        <div class="alert span6 offset3">
                                <h3 class="center">Oh SNAP - you've got a Problem!</h3>
                                
                                <!--requirement errors-->
                                <?php if ($type == 'screen'): ?>
                                <p class="center">
                                    It appears GNU Screen isn't installed! <br />
                                    In a terminal you should run:<br />
                                    <b>apt-get install screen</b><br />
                                </p>
                                <?php endif; ?>
                                
                                <?php if ($type == 'php'): ?>
                                <p class="center">
                                    It appears Your PHP Isn't Version: <?php echo $req['PHP'] ?><br />
                                    <b>Time to UPGRADE PHP boss.</b><br />
                                </p>
                                <?php endif; ?>
                                
                                <?php if ($type == 'write'): ?>
                                <p class="center">
                                    It appears Your <?php echo APPLICATION_DIR; ?>config isn't writable!<br />
                                    <b>perhaps run <b>chmod -R 755 /var/www/app/config</b><br />
                                </p>
                                <?php endif; ?>
                                
                                <?php if ($type == 'bukkit-no-write'): ?>
                                <p class="center">
                                    It appears Your bukkit folder isn't writable!<br />
                                    <b>Remember: www-data needs read/write AND execute access to every file in your bukkit folder!<br />
                                </p>
                                <?php endif; ?>
                        </div>
                </div>
            </div>
        <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>
