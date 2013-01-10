<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script>
            $(document).ready(function() {
                $('#listing').load('<?php echo pf_config::get('main_page')?>/backups/view');
            });
            </script>
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">Backup Management</h3>
                        
                <div class="row">
                    <div class="six columns offset-by-three">
                        <div class="valid">
                            Backup Complete!
                        </div>
                    </div>
                </div>
            <div class="row">
                <div id="listing" class="twelve columns">
                    
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>
