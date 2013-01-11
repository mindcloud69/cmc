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
                    <h4 class="center">Add A User</h4>
                    <?php pf_forms::createForm('adduser','four columns offset-by-four panel',pf_config::get('main_page').'/users/add'); ?>
                    Username: <?php pf_forms::text('username', true, null, 'Username'); ?><br />
                    Password: <?php pf_forms::text('password', true, null, 'Password'); ?><br />
                    User Level: <?php pf_forms::options('level', 'level',array('Admin'=>'Admin','User'=>'User'),'User'); ?><br /><br />
                    <?php pf_forms::button('submit', 'Add User','success twelve button rounded'); ?>
                    <?php pf_forms::closeForm(); ?>
                    
                </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>