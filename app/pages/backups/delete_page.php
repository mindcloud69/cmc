<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">Backup Management</h3>
                        
            <div class="container">
                <div class="row">
                    <div class="valid">
                        File Deleted!<br />
                        File:<?php echo $data[0]; ?>
                    </div>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>
