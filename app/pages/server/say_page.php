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
                        <h1 class="center">Server Say What?</h1>

                        <?php pf_forms::createForm('say', 'serversay', pf_config::get('main_page').'/server/say', 'GET'); ?>
                        Server Says: <?php pf_forms::text('command', true, null, 'Enter What You Wish To Say');
                        pf_forms::button('submit','Say It!','button rounded');
                        ?>
                        
                        </div>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>