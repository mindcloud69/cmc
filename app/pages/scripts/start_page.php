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

<h1>Start Server Script</h1>

<?php pf_forms::createForm('startserver', 'startserver', pf_config::get('main_page').'/scripts/startup', "POST");?>
Max Amount Of Ram To Use:<br />

    <? pf_forms::options('maxram', 'maxram',array(
     '1024'=>'1GB Memory',
     '2048'=>'2GB Memory',
     '3072'=>'3GB Memory',
     '4096'=>'4GB Memory',
     '5120'=>'5GB Memory',
     '6144'=>'6GB Memory',
     '7168'=>'7GB Memory',
     '8192'=>'8GB Memory'
     ),$data['Maxram'])
?>
<br />
<?php pf_forms::button('submit','Start Server');?>
<?php pf_forms::closeForm();?>


</div><!-- END MAIN SPAN -->
				<div class="span1"></div>
			</div><!-- END ROW -->
                        <div class="footer center">
            <center><?php pf_core::loadTemplate('footer'); ?></center>
        </div>
		</div><!-- END CONTAINER -->
	</body>
</html>