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
                    <div class="span6 offset3">
                        <div id="error" class="alert" style="text-align:center;"><b>FATAL ERROR</b>:<?php echo $data['error']?> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span12">
                        <?php 
                        if (key_exists('debug', $data))
                        {
                                echo $data['debug'];
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>