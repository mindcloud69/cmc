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
                        #console { white-space: pre; }
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
                            
                            //set the HTML to the correct value
                            $( "#cpu").html(cpu +'%');
                            $( "#mem").html(mem +'%');
                            $( "#cores").html('CPU Usage Based On '+ cores +' Cores');
                            
                            
                            //change the bar's width based on cpu and core
                            if (cores = 1)
                                {
                                    $( "#cpu").animate({width: cpu * 4},500);
                                }
                            else if (cores = 2)
                                {
                                    $( "#cpu").animate({width: cpu * 2},500);
                                }
                            else if (cores = 4)
                                {
                                    $( "#cpu").animate({width: cpu},500);
                                }
                            else if (cores = 8)
                                {
                                    $( "#cpu").animate({width: cpu / 2},500);
                                }
                                
                            //same with mem usage                                
                            $( "#mem").animate({width: mem},500);
                                
                            //change the bar's colors based on new usage (values)'
                            colors("#cpu",cpu);
                            colors("#mem",mem);
                            
                            }); //end main json data call
                            
                            //updates player info etc
                            serverinfo();
                            
                            //updates our server log
                            $('#console').load('<?php echo pf_config::get('main_page')?>/data/log');
                            
                            //call yourself again after 5 seconds
                            setTimeout(updatestats,5000);
                        }
                        
                        function colors(selector,value)
                        {
                            if (value >= 75){
                                $(selector ).css({ 'background': '#D00' });
                            } else if (value >= 50){
                                $(selector ).css({ 'background': '#EE0' });
                            } else{
                                $(selector ).css({ 'background': '#0A0' });
                            }
                        }
                        
                        function serverinfo()
                        {
                            $.getJSON('<?php echo pf_config::get('main_page'); ?>/data/info',function(data){
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
                                                        <span id='cores'>CPU Usage Based On X Cores</span>
							<div id="cpuwrap" class="">
  								<div id="cpu" class="bar"></div>
							</div>
                                                        <br>
                                                        MEM Usage
							<div id="memwrap" class="">
  								<div id="mem" class="bar"></div>
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