<?php
//let's see if they installed the system already? (this data gets passed from the controller)
if ($data['installed'])
{
    echo 'installed already';
}
?>


<html>	
	<head>
		<title>Minecraft Server Control</title>
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="<?php echo pf_config::get('base_url'); ?>app/assets/js/main.min.js"></script>
		<link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/main.min.css" rel="stylesheet" media="screen">
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
		<script>
			$('#tab a').click(function (e) {
  				e.preventDefault();
  				$(this).tab('show');
			})
		
		
		</script>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/main-responsive.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container-fluid"> <!-- START CONTAINER -->
			<div class="row-fluid">
				<div class="span1"></div>
				<div class="span10">
					<?php pf_core::loadTemplate('menu'); ?>
					<center>
						<form class="form-signin" name="installform" method="POST" action="install/go">
							<legend>Administrator Details</legend>
							<input type="text" name="adminname" placeholder="Admin Username"><br>
							<input type="text" name="adminpass" placeholder="Password"><br>
						
							<legend>Bukkit Details</legend>
							<input type="text" name="bukkitdir" placeholder="Bukkit Install Directory"><br><br>
                                                        <input type="submit" value="SAVE" />
						</form>
					</center>
				</div><!-- END MAIN SPAN -->
				<div class="span1"></div>
			</div><!-- END ROW -->
                        <div class="footer center">
            <?php pf_core::loadTemplate('footer'); ?>
        </div>
		</div><!-- END CONTAINER -->
	</body>
</html>