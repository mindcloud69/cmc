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
            <h4 class="center">Edit Page Access</h4>
                        
                <div class="row">
                    <?php
                    if (isset($saved))
                    {
                        echo '<div class="valid four offset-by-four">Settings Saved!</div><br /><br />';
                    }
                    ?>
                    
                    <?php pf_forms::createForm('access','six columns centered panel',MAIN_PAGE.'/users/access','POST'); ?>
                    
                    
                    <div class="info center">User Pages are ALWAYS Admin Only!</div><br />
                    
                    <div class="row">
                        <div class="three columns">
                            <label class="right inline">Config Pages:</label>
                        </div>
                        <div class="nine columns">
                            <?php pf_forms::options('config', 'config',array('Admin'=>'Admin','User'=>'User'),$data['config']); ?>
                        </div>
                    </div>
                    <br />
                    
                    <div class="row">
                        <div class="thre columns">
                            <label class="right inline">Server Pages:</label>
                        </div>
                        <div class="nine columns">
                            <?php pf_forms::options('server', 'server',array('Admin'=>'Admin','User'=>'User'),$data['server']); ?>
                        </div>
                    </div>
                    <br />
                    
                    <div class="row">
                        <div class="three columns">
                            <label class="right inline">Backup Pages:</label>
                        </div>
                        <div class="nine columns">
                            <?php pf_forms::options('backup', 'backup',array('Admin'=>'Admin','User'=>'User'),$data['backup']); ?>
                        </div>
                    </div>
                    <br />
                    
                    <div class="row">
                        <div class="three columns">
                            <label class="right inline">Player Pages:</label>
                        </div>
                        <div class="nine columns">
                            <?php pf_forms::options('players', 'players',array('Admin'=>'Admin','User'=>'User'),$data['players']); ?>
                        </div>
                    </div>
                    <br />
                    
                    <div class="row">
                        <div class="three columns">
                            <label class="right inline">CMC Settings:</label>
                        </div>
                        <div class="nine columns">
                        <?php pf_forms::options('settings', 'settings',array('Admin'=>'Admin','User'=>'User'),$data['settings']); ?>    
                        </div>
                    </div>
                    <br />
                    
                    <div class="row">
                        <div class="twelve columns centered">
                            <?php pf_forms::button('submit', 'Edit Access','button rounded twelve'); ?>
                        </div>
                    </div>
                    <?php pf_forms::closeForm(); ?>
                    
                </div>
            
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>