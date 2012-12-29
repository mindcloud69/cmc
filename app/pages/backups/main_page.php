<?php 
if ($data['last_backup']==false)
{
    $last_backup = '<span style="color:red;">No Previous Backups! BAD ADMIN!</span>';
}
else $last_backup = $data['last_backup'];

?>

<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
            <script>
            $(document).ready(function() {
                $('.submit').click(update);
                $('#backingup').hide();
            });
            
            function update()
            {
                $('#main').hide();
                $('#backingup').show();
            }
            
            </script>
            
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">Backup Management</h3>
                        
            <div class="container">
                <div id='loading'class="row"><div id='backingup' class="info span4 offset4 " style="margin-bottom:25px;">BACKUP IN PROGRESS!<br /></div><br /><br /></div>
                <div id="main" class="row">
                    <h3 class="center">Manual Backup</h3>
                    <?php pf_forms::createForm('backup', 'backupform span4 offset4', pf_config::get('main_page')."/backups/action", 'POST'); ?>
                    
                    <p>Your Last Backup Was:<br />
                    <?php echo $last_backup; ?><br /></p>
                    
                    <p>Please check all worlds you wish to backup.</p>
                    <label class="checkbox"><?php pf_forms::checkbox('world1', $data[0], $data[0]);?></label>
                    <label class="checkbox"><?php if (key_exists(1, $data)) pf_forms::checkbox('world2', $data[1], $data[1]);?></label>
                    <label class="checkbox"><?php if (key_exists(2, $data)) pf_forms::checkbox('world3', $data[2], $data[2]);?></label>
                    <?php pf_forms::button('submit', 'Manual Backup', 'button rounded span4 submit'); ?>
                    <?php pf_forms::closeForm();?>
                <br />
                </div>
                
                <div class="row">
                    <div class="span4 offset4 info">Warning: Backups can take a long time to complete.</div><br />
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>
