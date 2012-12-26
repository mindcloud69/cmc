<!DOCTYPE html>
<html>
	<head>
		<?php pf_core::loadTemplate('header'); ?>
                <style>
                    select {width:100px;}
                    input[type=text] {
                       width: 100px;
                    }
                </style>
	</head>
        
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            
            <div class="container">
                <h3 class="center">SUCCESS!</h3>
                <div class="row">
                    <div class="span12">
                    <p class="center">
                        Here is your config file as it was generated. It has already been saved for you.<br />
                        If all looks good, go ahead and <a href="<?php echo pf_config::get('main_page').'/scripts'; ?>">Click Here</a>
                        To Start/Restart The Server
                    </p>
                    <pre>
                    <?php echo $data['file']; ?>
                    </pre>
                    </div>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
        </body>
</html>