<html>	
	<head>
		<title>Minecraft Server Control</title>
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
                <script src="<?php echo pf_config::get('base_url'); ?>app/assets/js/main.min.js"></script>
		<link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/main.min.css" rel="stylesheet" media="screen">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/main-responsive.min.css" rel="stylesheet">
                <link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/style.css" rel="stylesheet">
        
                <style>
                    body {
				margin-top: 20px;
				background-color: #f5f5f5;
			}
                </style>


                 <script type="text/javascript">
                        //for our debug info
                        $(document).ready(function(){ 
                            $('.show_hide').showHide({speed: 500,changeText: 1,showText: 'View',hideText: 'Close'});  
                            $("#debug").hide(); 
                        }); 
                </script>


</head>
        <body>
            <div class="container-fluid"> <!-- START CONTAINER -->
			<div class="row-fluid">
				<div class="span1"></div>
				<div class="span10">
					<?php pf_core::loadTemplate('menu'); ?>
                                    
                                    
<div id="error" class="alert" style="text-align:center;"><b>FATAL ERROR</b>:<?php echo $data['error']?> </div>
<?php 
if (key_exists('debug', $data))
{
        echo $data['debug'];
}
?>
 </div><!-- END MAIN SPAN -->
				<div class="span1"></div>
			</div><!-- END ROW -->
                        <div class="footer center">
            <center><?php pf_core::loadTemplate('footer'); ?></center>
        </div>
		</div><!-- END CONTAINER -->
	</body>
</html>
