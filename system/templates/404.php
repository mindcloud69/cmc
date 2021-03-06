<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script type="text/javascript">
                //for our debug info
                $(document).ready(function(){ 
                    $('.show_hide').showHide({speed: 500,changeText: 1,hideText: 'Close'});  
                    $("#debug").hide(); 
                }); 
            </script>
	</head>
        <body>
            
        <div id="phils404">
        <h1 class="center">404!</h1>
        <h2 class="center">Oh Snap, You Broke The Internets</h2>
        <p class="center">
            Not really, but the page your looking for doesn't actually exist.<br />
            Perhaps you should double check your link and make sure it's correct or <br/>
            <a class="large" href="<?php echo pf_config::get('base_url').pf_config::get('index_page');?>"> Hit up the main site</a>
        </p>
        <div id="error" class="alert" style="text-align:center;width:400px;"><b>FATAL ERROR</b>:<?php echo $data;?> </div>
        <p class="center">Powered by <?php echo APP_NAME . '-' . APP_VERSION; ?></p>
        <?php pf_events::eventsDisplay();?>
        </div>
            
        <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>    
<?php die(); ?>