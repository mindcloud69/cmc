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
                    
                    <?php
                    if (!empty($data['backups']))
                    {
                        
                    //table of old backups
                    $table = new pf_tables();
                    $table->startTable('backups', 0, null, 'table table-striped span6 offset3');
                    $table->startRow();
                    $table->addTableHeading('Previous Backups');
                    $table->addTableHeading('Delete');
                    $table->endRow();
                    foreach ($data['backups'] as $backup)
                    {
                        $table->startRow();    
                        $table->addCell('<center>'.$backup.'</center>');
                        $table->addCell('<a class="button rounded span1" href="../backups/delete?file='.$backup.'">Delete</a>','center');
                        $table->endRow();
                    }
                    $table->renderTable();
                    }
                    
                    ?>

                    </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>
