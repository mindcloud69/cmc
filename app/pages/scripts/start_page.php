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

<form id="startserver" action="<?php echo pf_config::get('main_page');?>/scripts/startup" method="POST">
    Amount Of Ram To Reserve At Startup:
    <select name="startram">
        <option value="1024">1Gb Memory</option>
        <option value="2048">2Gb Memory</option>
        <option value="3072">3Gb Memory</option>
        <option value="4096">4Gb Memory</option>
        <option value="5120">5Gb Memory</option>
        <option value="6144">6Gb Memory</option>
        <option value="7168">7Gb Memory</option>
        <option value="8192">8Gb Memory</option>
    </select>
    Previously <?php echo ($data['Startram']/1024); ?>GB
    <br />
    Max Amount Of Ram To Use:
    <select name="maxram">
        <option value="1024">1Gb Memory</option>
        <option value="2048">2Gb Memory</option>
        <option value="3072">3Gb Memory</option>
        <option value="4096">4Gb Memory</option>
        <option value="5120">5Gb Memory</option>
        <option value="6144">6Gb Memory</option>
        <option value="7168">7Gb Memory</option>
        <option value="8192">8Gb Memory</option>
    </select>
    Previously <?php echo ($data['Maxram']/1024); ?>GB
    <br />
    <input type="submit" value="Save and Start Server"/>
</form>


</div><!-- END MAIN SPAN -->
				<div class="span1"></div>
			</div><!-- END ROW -->
                        <div class="footer center">
            <center><?php pf_core::loadTemplate('footer'); ?></center>
        </div>
		</div><!-- END CONTAINER -->
	</body>
</html>