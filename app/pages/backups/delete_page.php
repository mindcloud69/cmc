<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="refresh" content="2;URL='<?php echo MAIN_PAGE; ?>/backups'" />  
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">Backup Management</h3>
                        
            <div class="container">
                <div class="row">
                    <div class="valid">
                        Success!<br />
                        Selected Backups Deleted!<br />
                    </div>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>
