<?php
//get bukkit dir
$bukkit_dir = CMC::getCMCSetting('bukkit_dir'); 
//get our config
mcController::getMCConfig($bukkit_dir.DS.'server.properties');
//our current level
$current_level = mcController::getSetting('level-name');
        
?>

<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">World Management</h3>
                        
            <div class="row">
                <div class="eight columns centered panel">
                    <h5 class="center">Worlds On Server</h5>
                    <p class="center"><span style="color: red;">* - in use</span> denotes the level is currently in use in our server config</p>
                    <?php
                    $table = new pf_tables();
                    $table->startTable('worlds', 0, 100, 'table');
                    $table->startRow();
                    $table->addTableHeading('World');
                    $table->addTableHeading('Backup');
                    $table->addTableHeading('Delete');
                    $table->endRow();
                    foreach ($data as $world)
                    {
                        $level = substr($world, strlen($bukkit_dir)+1);
                        $pos = strpos($level, $current_level); //does it include our level?
                        
                        $table->startRow();
                        
                        //if the current level is in use, we note it.
                        if ($pos !==false)
                        {  
                         $table->addCell(substr($world, strlen($bukkit_dir)+1) . '<span style="color: red;"> * - in use</span>'); //in use
                        }
                        else //not in use
                        {
                            $table->addCell(substr($world, strlen($bukkit_dir)+1));
                        }
                        $table->addCell('<a href="'.MAIN_PAGE.'/backups?level='.substr($world, strlen($bukkit_dir)+1).'" class="button success rounded">Backup</a>');
                        $table->addCell('<a href="'.MAIN_PAGE.'/worlds/delete?level='.substr($world, strlen($bukkit_dir)+1).'" class="button alert rounded">Delete World</a>');
                        $table->endRow();
                    }
                    $table->renderTable();
                    ?>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>

