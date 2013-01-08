<?php
if (!$data['restart_check'])
{
    $data['restart_check'] = '15';
}


$logselect = range(100,1000,100);//generate an array counting from 100 to 1000 by 100's
$cronjob = range(1,59);//generate an array counting from 1 to 59 by 1's

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
                    
                    <table class="span6 offset1" cellpadding="5">
                        <tr>
                            <th>Setting</th>
                            <th>Value</th>
                            <th>Description</th>
                        </tr>
                        <tr>
                            <td>Bukkit Dir:</td>
                            <td><?php pf_forms::text('bukkit_dir', true, $data['bukkit_dir'], null);?></td>
                            <td>Where Bukkit is installed.</td>
                        </tr>
                        <tr>
                            <td>Bukkit Release Channel:</td>
                            <td><?php pf_forms::options('bukkit_channel', 'bukkitchannel', array('Recommeded'=>'Recommended','Beta'=>'Beta','Dev'=>'Dev'),$data['bukkit_channel']); ?></td>
                            <td>Preferred Channel of Bukkit. Used When CMC Downloads Updates</td>
                        </tr>
                        <tr>
                            <td>Log Lines:</td>
                            <td><?php pf_forms::options('log_lines', 'loglines',$logselect,$data['log_lines'])?></td>
                            <td>Number of lines to load from the log on the main page</td>
                        </tr>
                        <tr>
                            <td>Auto Restart Check:</td>
                            <td><?php pf_forms::options('auto_restart', 'auto_restart', $cronjob, $data['restart_check']);?></td>
                            
                            <td>Number Of Minutes to check for a hung server if restart on crash is enabled</td>
                        </tr>

                    
                    
                    </table>
                    <br />
                        <?php pf_forms::button('submit', 'Save CMC Config', 'button rounded span8'); ?>
                        <?php pf_forms::closeForm();?>
                </div>
             </div>
        
            <?php pf_core::loadTemplate('footer'); ?>
	</body>
</html>