<html>	
	<head>
		<title>Minecraft Server Control</title>
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
                <script src="<?php echo pf_config::get('base_url'); ?>app/assets/js/main.min.js"></script>
		<link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/main.min.css" rel="stylesheet" media="screen">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/main-responsive.min.css" rel="stylesheet">
                <link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/style.css" rel="stylesheet">
	</head>
        <body>
            <div class="container-fluid"> <!-- START CONTAINER -->
			<div class="row-fluid">
				<div class="span1"></div>
				<div class="span10">
					<?php pf_core::loadTemplate('menu'); ?>
                                    
                                    
            <div id="login" class="" style="padding-top:100px;">
                <form id="login" action="<?php echo pf_config::get('base_url').pf_config::get('index_page')?>/login/action" method="POST">
                        
                    <legend>Please Login</legend>
                    
                    <label for="username">
                        Username:
                        <input type="text" name="username" placeholder="Username" required/>
                    </label>
                    <label for="password">
                        Password:
                        <input type="password" name="password" placeholder="Password" required />
                    </label>
                    <input class="button" type="submit" value="Login"/>
                    
                </form>
            </div>

       </div><!-- END MAIN SPAN -->
				<div class="span1"></div>
			</div><!-- END ROW -->
                        <div class="footer center">
            <?php pf_core::loadTemplate('footer'); ?>
        </div>
		</div><!-- END CONTAINER -->
	</body>
</html>