<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">User Management</h3>
                        
            <div class="container">
                <div class="row">
                    <div class="span3 right">
                            <a class="button rounded" href="<?php echo pf_config::get('main_page') ?>/users/add">Add User</a><br /><br />
                    </div>
                    <div class="span9">
                        <?php

			$table = new pf_tables();
        
			$table->startTable('users',0,NULL,'table table-striped span5');
			$table->startRow();
			$table->addTableHeading('ID');
			$table->addTableHeading('Name');
			$table->addTableHeading('Level');
			$table->addTableHeading('Delete');
			$table->endRow();

			foreach ($data as $user)
			{
    			$table->startRow();
    			$table->addCell($user['ID']);
   				$table->addCell($user['User']);
    			$table->addCell($user['Level']);
    			$table->addCell('<a class="button rounded center" href="'.pf_config::get('main_page').'/users/delete?id='.$user['ID'].'">Delete </a>');
    			$table->endRow();
			}

			$table->renderTable();
                        ?>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="span6 offset3">
                        <p>
                            Please NOTE: Currently there is no difference between admins/users. This will be worked on in beta. We hope to make it
                            possible to configure what section users have access to in the stable release.
                        </p>
                        <br />
                    </div>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>