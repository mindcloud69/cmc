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
                    <div class="span6">
                        <h3>Please pick a script to run.</h3>
                        <p>
                            Please NOTE: Stopping / Starting the server takes time and is ran in the background.
                            You can watch their progress from the main page by watching the server log as they run.
                            Please Give the scripts time to work. These will be configurable in the next version.
                        </p>
                        <br />
                    </div>
                    <div class="span6">
                            <span class="button rounded"><a href="<?php echo pf_config::get('main_page') ?>/server/startup">Startup Script</a></span><br />
                            <span class="button rounded"><a href="<?php echo pf_config::get('main_page') ?>/server/stop">Stop Script</a></span><br />
                            <span class="button rounded"><a href="<?php echo pf_config::get('main_page') ?>/server/say">Say</a></span><br />
                            <span class="button rounded"><a href="<?php echo pf_config::get('main_page') ?>/server/action">Issue Command</a></span><br />
                    </div>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>