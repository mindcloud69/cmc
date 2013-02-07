<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
            <script>
            $(document).ready(function(){ 
                $('#start').click(function() {
                    $('#load').load ('<?php echo pf_config::get('main_page')?>/server/startstop');
                });

                $('#say').click(function() {
                    $('#load').load ('<?php echo pf_config::get('main_page')?>/server/say');
                });
                $('#command').click(function() {
                    $('#load').load ('<?php echo pf_config::get('main_page')?>/server/action');
                });

            });
            </script>
            
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">Server Commands</h3>
                        
                <div class="row">
                    <div class="four columns">
                        <ul class="nav-bar vertical">
                            <li id="config"><a href="<?php echo pf_config::get('main_page'); ?>/config"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/wrench.png"/>&nbsp;Config</a></li>
                            <li id="start"><a href="#"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/broadcast.png"/>&nbsp;Start/Stop Server</a></li>
                            <li id="command"><a href="#"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/rocket.png"/>&nbsp;Commands</a></li>
                            <li id="say"><a href="#"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/comments.png"/>&nbsp;Say</a></li>
                            <li id="say"><a href="<?php echo MAIN_PAGE ?>/data/clearlog"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/book.png"/>&nbsp;Clear Log</a></li>
                            <li id="update"><a href="<?php echo pf_config::get('main_page')?>/server/update"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/update.png"/>&nbsp;Update Server</a></li>
                        </ul>
                    </div>
                    
                    <div class="eight columns">
                        <p class="panel">
                            Please NOTE: Stopping / Starting the server takes time and is ran in the background.
                            You can watch their progress from the main page by watching the server log as they run.
                            Please Give the scripts time to work. These will be configurable in future versions.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div id="load" class="ten columns offset-by-one">

                    </div>
                </div>
                        
                    
                    <div class="four columns right">
                            
                    </div>
                </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>