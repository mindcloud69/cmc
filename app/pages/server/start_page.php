<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
                <div class="row">
                    <div class="four columns offset-by-four panel">
                        <h3 class="center">Start Server</h3>
                        
                                <?php pf_forms::createForm('startserver', 'startserver center', pf_config::get('main_page').'/server/startup', "POST");?>
                        
                                Max Amount Of Ram To Use:<br />

                                    <?php pf_forms::options('maxram', 'maxram',array(
                                     '1024'=>'1GB Memory',
                                     '2048'=>'2GB Memory',
                                     '3072'=>'3GB Memory',
                                     '4096'=>'4GB Memory',
                                     '5120'=>'5GB Memory',
                                     '6144'=>'6GB Memory',
                                     '7168'=>'7GB Memory',
                                     '8192'=>'8GB Memory'
                                     ),$data)
                                ?>
                                <br />
                                <?php pf_forms::checkbox('restart', 'Restart On Crash', 'true');?>
                                <?php pf_forms::button('submit','Start','button rounded center success');?>
                                <?php pf_forms::closeForm();?>
                    </div>
                </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>