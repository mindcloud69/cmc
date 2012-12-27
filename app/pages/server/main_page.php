<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">Server Do What?</h3>
                        
            <div class="container">
                <div class="row">
                    <div class="span3 right">
                            <a class="button rounded" href="<?php echo pf_config::get('main_page') ?>/server/startup">Start Server</a><br /><br />
                            <a class="button rounded" href="<?php echo pf_config::get('main_page') ?>/server/stop">Stop Server</a><br /><br />
                            <a class="button rounded" href="<?php echo pf_config::get('main_page') ?>/server/action">Issue Command</a><br /><br />
                            <a class="button rounded" href="<?php echo pf_config::get('main_page') ?>/server/say">Server Say</a><br /><br />
                    </div>
                    <div class="span6">
                        <p>
                            Please NOTE: Stopping / Starting the server takes time and is ran in the background.
                            You can watch their progress from the main page by watching the server log as they run.
                            Please Give the scripts time to work. These will be configurable in the next version.
                        </p>
                        <br />
                    </div>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>