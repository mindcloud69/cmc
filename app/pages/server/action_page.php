<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <div class="container">
                <div class="row">
                    <div class="span4 offset4">
                        <h1 class="center">Issue Server Command</h1>

                        <?php pf_forms::createForm('say', 'servercommand', pf_config::get('main_page').'/server/action', 'GET'); ?>
                        Command Type: 
                            <?php pf_forms::options('action', 'action',array(
                                'Ban'=>'Ban',
                                'Unban'=>'Unban',
                                'Kick'=>'Kick'
                                )); ?>
                        Command Object: <?php pf_forms::text('command', true, null, 'Object Of Command I.E. Username');
                        pf_forms::button('submit','Do It!','button rounded');
                        ?>
                        
                        </div>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>