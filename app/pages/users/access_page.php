<?php
if (key_exists('saved', $data))
{
    $saved=true;
}
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
                    <?php
                    if (isset($saved))
                    {
                        echo '<div class="valid span4 offset4">Settings Saved!</div><br /><br />';
                    }
                    ?>
                    
                    <?php pf_forms::createForm('access','span4 offset4',MAIN_PAGE.'/users/access','POST'); ?>
                    <legend class="center">Edit Page Access</legend>
                    
                    
                    <div class="info">User Pages are ALWAYS Admin Only!</div>
                    
                    Config Pages: <?php pf_forms::options('config', 'config',array('Admin'=>'Admin','User'=>'User'),$data['config']); ?><br />
                    Server Pages: <?php pf_forms::options('server', 'server',array('Admin'=>'Admin','User'=>'User'),$data['server']); ?><br />
                    Backups Pages: <?php pf_forms::options('backup', 'backup',array('Admin'=>'Admin','User'=>'User'),$data['backup']); ?><br />
                    CMC Settings : <?php pf_forms::options('settings', 'settings',array('Admin'=>'Admin','User'=>'User'),$data['settings']); ?><br />
                    
                    <?php pf_forms::button('submit', 'Edit Access','button rounded span4'); ?>
                    <?php pf_forms::closeForm(); ?>
                    
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>