<?php
$newpass = pf_core::randomCode(8);
?>

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
                    
                    <?php pf_forms::createForm('edituser','span4 offset4',MAIN_PAGE.'/users/edit','POST'); ?>
                    <legend class="center">Edit <?php echo $data['User'] ?></legend>
                    <input type="checkbox" name="resetpass" value="<?php echo $newpass; ?>"/> Set Password To: <?php echo $newpass;?> <br />
                    <br />
                    OR<br />
                    <br />
                    Set Password To: <input type="text" name="newpass" /> <br />
                    User Level: <?php pf_forms::options('level', 'level',array('Admin'=>'Admin','User'=>'User'),$data['Level']); ?><br />
                    <input type="hidden" name="id" value="<?php echo $data['ID']?>" />
                    <?php pf_forms::button('submit', 'Edit User','button rounded span4'); ?>
                    <?php pf_forms::closeForm(); ?>
                    
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>