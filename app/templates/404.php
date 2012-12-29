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
        <?php pf_core::loadTemplate('menu'); ?>
            <div class="container">
                <div class="row">
                        <h1 class="center">404!</h1>
                        <h2 class="center">Oh Snap, You Broke The Internets</h2>
                        <div id="error" class="alert span6 offset3" style="text-align:center;"><b>FATAL ERROR</b>:<?php echo $data;?> </div>                    
                </div>
                <div class="row">
                        <p class="center">
                            Not really, but the page your looking for doesn't actually exist.<br />
                            Perhaps you should double check your link and make sure it's correct or <br/>
                            <a class="large" href="<?php echo pf_config::get('base_url').pf_config::get('index_page');?>"> Hit up the main site</a>
                        </p>
                        <?php pf_events::eventsDisplay();?>
                </div>
        <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>    
<?php die(); ?>