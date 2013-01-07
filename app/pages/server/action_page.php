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
                    
                        <h1 class="center">Issue Server Command</h1>

                        <?php pf_forms::createForm('say', 'span4 offset4', pf_config::get('main_page').'/server/action', 'GET'); ?>
                        Command Type: 
                            <?php pf_forms::options('action', 'action',array(
                                'ban'=>'Ban',
                                'pardon'=>'Unban',
                                'ban-ip'=>'Ban-ip',
                                'pardon-ip'=>'Pardon-ip',
                                'kick'=>'Kick',
                                'op'=>'Op',
                                'deop'=>'Deop',
                                'custom' => 'Custom'
                                )); ?>
                        Command Object: <?php pf_forms::text('command', true, null, 'Object Of Command I.E. Username');
                        pf_forms::button('submit','Do It!','button rounded span4');
                        ?>
                        
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>