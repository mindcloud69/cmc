<html>
	<head>
	
	
	</head>
	<body>
		<?php

			$table = new pf_tables();
        
			//create some pretty (?) tables  $table->startTable($id, $border, $width, $class) <-- note you can set multiple classes
			$table->startTable('users',0,NULL,'table table-striped');
			$table->startRow();
			$table->addCell('ID');
			$table->addCell('Name');
			$table->addCell('Level');
			$table->addCell('Delete');
			$table->endRow();

			foreach ($data as $user)
			{
    			$table->startRow();
    			$table->addCell($user['ID']);
   				$table->addCell($user['User']);
    			$table->addCell($user['Level']);
    			$table->addCell('<a href="'.pf_config::get('main_page').'/users/delete?id='.$user['ID'].'">Delete </a>');
    			$table->endRow();
			}

			$table->renderTable();
		?>
		
		<a href="<?php echo pf_config::get('main_page');?>/users/add">Add A User</a>

	</body>
</html>