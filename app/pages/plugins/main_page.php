<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">Pluggin  Management</h3>
                        
                <div class="row">
                    <h5 class="center">Pluggins Currently Installed</h5>
                    <div class="twelve columns centered">
                        <p class="warning center">Be careful with the delete button, there is no undo or confirmation.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="six columns">
                    <?php 
                    $table = new pf_tables();
                    $table->startTable('pluggins', 1, 100, 'table table-stripped');
                    $table->startRow();
                    $table->addTableHeading('Pluggin Name');
                    $table->addTableHeading('Delete');
                    $table->endRow();
                    foreach ($data as $pluggin)
                    {
                        $table->startRow();
                        $table->addCell($pluggin);
                        $table->addCell('<a href="'.MAIN_PAGE.'/pluggins/delete?file='.$pluggin.'" class="button alert rounded">Delete Pluggin</a>');
                        $table->endRow();
                    }
                    $table->renderTable();
                    ?>
                    </div>
                </div>
            
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>
