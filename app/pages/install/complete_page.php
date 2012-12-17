<!DOCTYPE html>
<html>
	<head>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="<?php echo pf_config::get('base_url'); ?>app/assets/js/main.min.js"></script>
		<link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/main.min.css" rel="stylesheet" media="screen">
	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/main-responsive.min.css" rel="stylesheet">
		<style>
			p {
				font-size:25px;
			}
			
			
		</style>
	</head>
	<body>
		<div class="container-fluid"> <!-- START CONTAINER -->
			<div class="row-fluid">
				<div class="span1"></div>
				<div class="span10">
					<?php pf_core::loadTemplate('menu'); ?><br>
					<h1>Woo! Your CMC system is now installed!</h1>
					<hr>
					<p >I know, it's really exciting. Look, there's even a menu at the top. Feel free to play around with it. To start, click the "Home" button to begin managing your server with ease.</p>
				</div> <!-- END SPAN10 -->
				<div class="span1"></div>
			</div><!-- END ROW -->
		</div><!-- END CONTAINER -->
	
	</body>
</html>