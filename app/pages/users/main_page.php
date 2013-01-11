<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">User Management</h3>
                        
                <div class="row">
                        <?php
			$table = new pf_tables();
			$table->startTable('users',0,NULL,'table table-striped ten columns offset-by-one');
			$table->startRow();
			$table->addTableHeading('ID');
			$table->addTableHeading('Name');
			$table->addTableHeading('Level');
                        $table->addTableHeading('Edit');
			$table->addTableHeading('Delete');
			$table->endRow();

			foreach ($data as $user)
			{
    			$table->startRow();
    			$table->addCell($user['ID']);
                        $table->addCell($user['User']);
    			$table->addCell($user['Level']);
                        $table->addCell('<center><a style="width:80px;" class="button rounded secondary" href="'.pf_config::get('main_page').'/users/edit?id='.$user['ID'].'">Edit </a></center>');
    			$table->addCell('<center><a style="width:80px;" class="button rounded alert" href="'.pf_config::get('main_page').'/users/delete?id='.$user['ID'].'&user='.$user['User'].'">Delete </a></center>');
    			$table->endRow();
			}

			$table->renderTable();
                        ?>
                </div>
                <div class="row">
                    <div class="ten columns offset-by-one">
                        <p class="six columns center">
                            <a class="button rounded success" href="<?php echo MAIN_PAGE ?>/users/add">Add A User</a>
                        </p>
                        <p class="six columns center">
                            <a class="button rounded secondary" href="<?php echo MAIN_PAGE ?>/users/access">Page Access Control</a>
                        </p>
                        <br />
                    </div>
                </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>