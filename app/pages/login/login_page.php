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
			
			.form-signin {
        		max-width: 300px;
       			padding: 19px 29px 29px;
        		margin: 0 auto 20px;
        		background-color: #fff;
        		border: 1px solid #e5e5e5;
        		-webkit-border-radius: 5px;
           		-moz-border-radius: 5px;
                border-radius: 5px;
        		-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           		-moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      		}
      		
      		.form-signin .form-signin-heading, .form-signin .checkbox {
       		 	margin-bottom: 10px;
      		}
      		
      		.form-signin input[type="text"], .form-signin input[type="password"] {
       			font-size: 16px;
        		height: auto;
        		margin-bottom: 15px;
        		padding: 7px 9px;
      		}
		</style>
	</head>
        <body>
            <div class="container-fluid"> <!-- START CONTAINER -->
			<div class="row-fluid">
				<div class="span1"></div>
				<div class="span10">
					<?php pf_core::loadTemplate('menu'); ?>
                                    
                                    
            <div id="login" class="" style="padding-top:100px;">
                <form class="form-signin" id="login" action="<?php echo pf_config::get('base_url').pf_config::get('index_page')?>/login/action" method="POST">
                        
                    <legend>Please Login</legend>
                    
                    <center><label for="username">
                        <input type="text" name="username" placeholder="Username" required/>
                    </label></center>
                    <center><label for="password">
                        <input type="password" name="password" placeholder="Password" required />
                    </label></center>
                    <center><input class="btn-primary" type="submit" value="Login"/></center>
                    
                </form>
            </div>

       </div><!-- END MAIN SPAN -->
				<div class="span1"></div>
			</div><!-- END ROW -->
                        <div class="footer center">
            <center><?php pf_core::loadTemplate('footer'); ?></center>
        </div>
		</div><!-- END CONTAINER -->
	</body>
</html>