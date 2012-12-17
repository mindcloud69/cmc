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
                        
                        #cpuwrap,#memwrap{color:black;border:1px solid black;width:400px;}
		</style>
		<script>
			$('#tab a').click(function (e) {
  				e.preventDefault();
  				$(this).tab('show');
			})
		
                        function updatestats ()
                        {
                            //grab some general stats from the server
                            $.getJSON('<?php echo pf_config::get('base_url'); ?>index.php/data/general',function(data){
                            
                            //assign some vars based off the data
                            var cores = (data['CORES']); //number of cores on the server
                            var cpu = data['CPU'] / cores;
                            var mem = data['MEM'] ;
                            
                            cores = 8;
                            
                            $('#cpuwrap').css({'width':cores*100});
                            
                            
                            //set the HTML to the correct value
                            $( "#cpu").html("CPU: "+ cpu +'%');
                            $( "#mem").html("MEM: "+ mem +'%');
                            
                            $( "#cpu").animate({width: cpu},500);
                            $( "#mem").animate({width: mem},500);
                            
                            });
                            
                            colors("#cpu",cpu);
                            colors("#mem",mem);
                            
                            serverinfo();
                            //call yourself again after 5 seconds
                            setTimeout(updatestats,5000);
                        }
                        
                        function colors(selector,value)
                        {
                            if (value > 70){
                                $(selector ).css({ 'background': 'Red' });
                            } else if (value > 50){
                                $(selector ).css({ 'background': 'Yellow' });
                            } else{
                                $(selector ).css({ 'background': '#0A0' });
                            }
                        }
                        
                        function serverinfo()
                        {
                            $.getJSON('<?php echo pf_config::get('base_url'); ?>index.php/data/info',function(data){
                                $( '#info' ).html ("Craftbukkit "+data['version'] +":<br />"
                                + data['players'] + " of " + data['max_players'] + ' players connected<br />' +
                                'MOTD:' + data['motd'] +'<br />')
                            });
                        }
                        
                        $(document).ready(function(){ 
                            updatestats();
                        });
                        
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
						<div class="span4">
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
							<div id="cpuwrap" class="">
  								<div id="cpu" class="bar" style="width: 40%;">CPU (40%)</div>
							</div><br>
							<div id="memwrap" class="">
  								<div id="mem" class="bar" style="width: 20%;">RAM (20%)</div>
							</div>
                                                        <div id="info">
                                                            
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