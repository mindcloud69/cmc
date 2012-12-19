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
	</head>
        <body>
            <div class="container-fluid"> <!-- START CONTAINER -->
			<div class="row-fluid">
				<div class="span1"></div>
				<div class="span10">
					<?php pf_core::loadTemplate('menu'); ?>
                                    
                                            <h1>Script saved</h1>
                                            Your server is now starting, give it a moment.<br />
                                            Perhaps you would like to <a href="<?php pf_config::get('main_page')?>">Click Here </a> to go the main page and watch the console?<br />
                                            <h2>Please Note</h2>
                                            Due to bukkit starting up, your server may be slow for a moment.<br />
                                            Please give the webpage time to update and don't refresh too often.<br />
                                            

</div><!-- END MAIN SPAN -->
				<div class="span1"></div>
			</div><!-- END ROW -->
                        <div class="footer center">
            <center><?php pf_core::loadTemplate('footer'); ?></center>
        </div>
		</div><!-- END CONTAINER -->
	</body>
</html>