<?php
//get bukkit dir
$bukkit_dir = CMC::getCMCSetting('bukkit_dir'); 
//get our config
mcController::getMCConfig($bukkit_dir.DS.'server.properties');
//our current level
$current_level = mcController::getSetting('level-name');


//get current world schedules
$schedules = CMC::getCMCSetting('scheduled_backups');
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
                <div class="ten columns centered panel">
                    <h5 class="center">Worlds On Server</h5>
                    <p class="center"><span style="color: red;">* - in use</span> denotes the level is currently in use in our server config</p>
                    <?php
                    $table = new pf_tables();
                    $table->startTable('worlds', 0, 100, 'table');
                    $table->startRow();
                    $table->addTableHeading('World');
                    $table->addTableHeading('Backup');
                    $table->addTableHeading('Delete');
                    $table->addTableHeading('Schedule');
                    $table->addTableHeading('Scheduled Time');
                    $table->endRow();
                    foreach ($data as $world)
                    {
                        //gets the level name
                        $level = substr($world, strlen($bukkit_dir)+1);
                        $pos = strpos($level, $current_level); //does it include our level?
                        
                        //is this level scheduled for backup?
                        if (key_exists($level, $schedules))
                        {
                            $time = $schedules[$level];
                        }
                        
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
                        
                        //backup button
                        $table->addCell('<a href="'.MAIN_PAGE.'/backups?level='.substr($world, strlen($bukkit_dir)+1).'" class="button success rounded">Backup</a>');
                        
                        //delete button
                        $table->addCell('<a href="'.MAIN_PAGE.'/worlds/delete?level='.substr($world, strlen($bukkit_dir)+1).'" class="button alert rounded">Delete World</a>');
                        
                        //if we have a scheduled backup at a time
                        if (isset($time))
                        {
                            $table->addCell('<a href="'.MAIN_PAGE.'/backups/schedule?dir='.substr($world, strlen($bukkit_dir)+1).'" class="button secondary rounded">Change Schedule</a>');
                            $table->addCell('Scheduled for <br />'.$time . '00 hours - nightly');
                        }
                        else
                        {
                            $table->addCell('<a href="'.MAIN_PAGE.'/backups/schedule?dir='.substr($world, strlen($bukkit_dir)+1).'" class="button secondary rounded">Schedule Backup</a>');
                            $table->addCell('No Schedule Setup');
                        }
                        $table->endRow();
                        $time = null;
                    }
                    $table->renderTable();
                    ?>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>

