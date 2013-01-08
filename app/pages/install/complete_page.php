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
                    <div class="span6 offset3">
                        <h3 class="valid center">Woot! CMC Installed!</h3>
                        <hr>
                        <p>I know, it's really exciting. Look, there's even a menu at the top. 
                            Feel free to play around with it. To start, click the <a href="<?php echo MAIN_PAGE; ?>">Home</a> button 
                            to see an overview of what's going on right now.
                        </p>
                        <p>
                            If you wish, there are a few more <a href="<?php echo MAIN_PAGE; ?>/settings">settings </a> you can play with.
                        </p>
                    </div>
                </div>
            </div><!-- END CONTAINER -->
	</body>
</html>