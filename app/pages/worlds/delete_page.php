<?php $bukkit_dir = CMC::getCMCSetting('bukkit_dir'); ?>

<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <?php echo '<meta http-equiv="refresh" content="5;url='.MAIN_PAGE.'/worlds">'; ?>
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">World Management</h3>
                        
            <div class="row">
                <div class="six columns centered">
                    <p class="valid"><?php echo $data ?> deleted!</p>
                    <p>You will be re-directed to the world listing page shortly.</p>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>

