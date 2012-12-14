<!DOCTYPE html>
<html>
	<head>
		<title>Minecraft Server Control</title>
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="js/main.min.js"></script>
		<link href="css/main.min.css" rel="stylesheet" media="screen">
		<style>
			body {
				margin-top: 20px;
			}
		</style>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/main-responsive.min.css" rel="stylesheet">
	</head>
	
	<body>
		<div class="container-fluid"> <!-- START CONTAINER -->
			<div class="row-fluid">
				<div class="span1"></div>
				
				<div class="span10">
					<h1>Minecraft Server Control</h1><hr>
					<div class="row-fluid">
						<div class="span6">
							<h2>General Info</h2>
							<strong>Online:</strong> <img height="12px" src="img/Circle_Green.png"><br>
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
					<br><br><strong>Console:</strong>
					<pre>
						<br><br><br><br><br><br><br><br><br><br>
					</pre>
				</div>
				<div class="span1"></div>
			</div> <!-- END ROW -->
		</div> <!-- END CONTAINER -->

	</body>

</html>