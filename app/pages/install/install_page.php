<?php
//let's see if they installed the system already? (this data gets passed from the controller)
if ($data['installed'])
{
    $installed = true;
}
else $installed=false;
?>


<html>	
	<head>
		<title>Minecraft Server Control</title>
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="<?php echo pf_config::get("base_url"); ?>app/assets/js/main.min.js"></script>
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
		
			$(".alert").alert()
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
                                    
                                    <?php if ($installed){?>
                                    	<!-- anything between these php tags is our error message -->
                                    	<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">x</button>
											<h4>Oh SNAP - you've already installed CMC!</h4>It's OK, don't panic, we can get through this together.
											Let's look at our options:<br>
											<ol>
												<li>"I didn't want this, send me back!" <button type="button" class="btn" data-dismiss="alert"><a href="<?php echo pf_config::get('base_url'); ?>index.php">Click here</a></button></li>
												<li>"Yes, I know what I'm doing, I know this WILL reset my install data" <button type="button" class="btn btn-danger" data-dismiss="alert">Click here</button></li>
											</ol>
										</div>
                                    <?php }?>
					<center>
						<form class="form-signin" name="installform" method="POST" action="install/go">
							<legend>Administrator Details</legend>
							<input type="text" name="adminname" placeholder="Admin Username"><br>
							<input type="text" name="adminpass" placeholder="Password"><br><br>
						
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