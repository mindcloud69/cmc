<!DOCTYPE html>
<html>
	<head>
		<?php pf_core::loadTemplate('header'); ?>
	</head>
        
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            
            <div class="row">
                <h3 class="center">SUCCESS!</h3>
                    <div class="twelve columns">
                        
                    <p class="center info">
                        Here is your config file as it was generated. It has already been saved for you.<br />
                        If all looks good, go ahead and <a href="<?php echo pf_config::get('main_page').'/server'; ?>">Click Here</a>
                        To Start/Restart The Server
                    </p>
                    <pre class="panel">
                    <?php echo $data['file']; ?>
                    </pre>
                    </div>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
        </body>
</html>