<?php
//makes our image src dynamic based on if online or not:)
if ($data['online'])
{
    $online = '<img height="12px" src="'.pf_config::get("base_url").'app/assets/site_images/Circle_Green.png" width="15px">';
    $status = '<span class="online" >ONLINE!</span>';
}
else
{
    $online = '<img height="12px" src="'.pf_config::get("base_url").'app/assets/site_images/Circle_Red.png" width="15px">';
    $status = '<span class="offline" >OFFLINE!</span>';

}
?>

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
				background:url('<?php echo pf_config::get('base_url'); ?>app/assets/site_images/noise.png') repeat 0px 0px;
                        }
                        .online{color:green;}
                        .offline{color:red;}
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
					<h1>Minecraft Server Control</h1><hr>
					<div class="row-fluid">
						<div class="span6">
							<h2>General Info</h2>
							<strong>Online: </strong> <?php echo $status . " " .$online; ?> <br>
							<strong>Bukkit Dir:</strong> <?php echo $data['bukkit_dir'];?> <br>
                                                        <strong>World:</strong> <?php echo $data['world'];?><br>
							<strong>PvP:</strong><?php echo $data['pvp'];?><br>
							<strong>Difficulty:</strong> <?php echo $data['difficulty'];?><br>
							<strong>Game Type:</strong> <?php echo $data['gamemode'];?><br>
							<strong>Essentials Installed:</strong><?php echo $data['essentials'];?> <br>
							<strong>Other Plugins:</strong> <?php echo $data['pluggins'];?>
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
                        <div class="footer center">
            <?php pf_core::loadTemplate('footer'); ?>
        </div>
		</div> <!-- END CONTAINER -->

	</body>

</html>