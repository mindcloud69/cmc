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

                                    <h1>Server Scripts</h1>
                                    <h3>Please pick a script to run.</h3>
                                    <h4>
                                        Please NOTE: Stopping / Restarting the server takes time, 
                                        your browser will "lock up" for a minute or more. Give the scripts
                                        time to work. You will be redirected to the main page after they have completed.
                                    </h4>
                                    
                                        <a href="<?php echo pf_config::get('main_page') ?>/scripts/startup">Startup Script</a><br />
                                        <a href="<?php echo pf_config::get('main_page') ?>/scripts/stop">Stop Script</a><br />
                                        <a href="<?php echo pf_config::get('main_page') ?>/scripts/restart">Restart Script</a><br />
                                        <a href="<?php echo pf_config::get('main_page') ?>/scripts/say">Say</a><br />


                                    </div><!-- END MAIN SPAN -->
				<div class="span1"></div>
			</div><!-- END ROW -->
                        <div class="footer center">
            <center><?php pf_core::loadTemplate('footer'); ?></center>
        </div>
		</div><!-- END CONTAINER -->
	</body>
</html>