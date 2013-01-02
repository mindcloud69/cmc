<?php
$logselect = array(
    '100'=>'100',
    '200'=>'200',
    '300'=>'300',
    '400'=>'400',
    '500'=>'500',
    '600'=>'600',
    '700'=>'700',
    '800'=>'800',
    '900'=>'900',
    '1000'=>'1000'
    );
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
                    <h1 class="center">Configure CMC</h1>
                    <?php pf_forms::createForm('config', 'config span8 offset2', pf_config::get('main_page')."/settings", 'POST'); ?>
                    
                    <table class="span6 offset1">
                        <tr>
                            <th>Setting</th>
                            <th>Value</th>
                            <th>Description</th>
                        </tr>
                        <tr>
                            <td>Bukkit Dir:</td>
                            <td><?php pf_forms::text('bukkit_dir', true, 'Bukkit Dir', null);?></td>
                            <td>Where Bukkit is installed.</td>
                        </tr>
                        <tr>
                            <td>Log Lines:</td>
                            <td><?php pf_forms::options('log_lines', 'loglines',$logselect)?></td>
                            <td>Number of lines to load from the log on the main page</td>
                        </tr>
                        <tr>
                            <td>Auto Restart Check:</td>
                            <td><?php pf_forms::text('auto_restart', true, '10', null);?></td>
                            <td>Number Of Minutes to check for a hung server if restart on crash is enabled</td>
                        </tr>

                    
                    
                    </table>
                        <?php pf_forms::button('submit', 'Save CMC Config', 'button rounded span8'); ?>
                        <?php pf_forms::closeForm();?>
                </div>
             </div>
        
            <?php pf_core::loadTemplate('footer'); ?>
	</body>
</html>