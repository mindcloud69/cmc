<!DOCTYPE html>
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
		</style>
		<script>
			$('#tab a').click(function (e) {
  				e.preventDefault();
  				$(this).tab('show');
			})
		
		
		</script>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="../assets/css/main-responsive.min.css" rel="stylesheet">
	</head>
	
	<body>
		<div class="container-fluid"> <!-- START CONTAINER -->
			<div class="row-fluid">
				<div class="span1"></div>
				
				<div class="span10">
					<div class="navbar">
						<div class="navbar-inner">
							<a class="brand" href="">CMC</a>
							<ul class="nav">
								<li class="active"><a href="">Home</a></li>
								<li><a href="">Config</a></li>
								<li><a href="">Login</a></li>
							</ul>
						</div>
					</div>
					<h1>Minecraft Server Control</h1><hr>
					<div class="row-fluid">
						<div class="span6">
							<h2>General Info</h2>
							<strong>Online:</strong> <img height="12px" src="../assets/site_images/Circle_Green.png"><br>
							<strong>World:</strong> world<br>
							<strong>PvP:</strong> false<br>
							<strong>Difficulty:</strong> 1<br>
							<strong>Game Type:</strong> Survival<br>
							<strong>Essentials Installed:</strong> Yes<br>
							<strong>Other Plugins:</strong> Blobcraft, piecraft, cheesecraft, this text can wrap as well
						</div>
						
						<div class="span6">
							<h2>Server Load</h2>
							<div class="progress progress-warning progress-striped active">
  								<div class="bar" style="width: 40%;">CPU (40%)</div>
							</div><br>
							<div class="progress progress-success progress-striped active">
								
  								<div class="bar" style="width: 20%;">RAM (20%)</div>
							</div>
						</div>
						
					</div> <!-- END MAIN CONTENT -->
					<br><br>
					<div class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#console" data-toggle="tab">Console</a></li>
							<li><a href="#chat" data-toggle="tab">Chat</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="console">
								<pre>
[Plugin X] is now Active!
Blah Blah Blah...
									<br><br><br><br><br><br><br><br><br><br>
								</pre>
							</div>
							<div class="tab-pane" id="chat">
								<pre>
Bob: Hi!
Joe: Yo!
									<br><br><br><br><br><br><br><br><br><br>
								</pre>
							</div>

				</div><!-- END 10 SPAN -->
				<div class="span1"></div>
			</div> <!-- END ROW -->
		</div> <!-- END CONTAINER -->

	</body>

</html>