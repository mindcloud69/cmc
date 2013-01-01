<!DOCTYPE html>
<html>
	<head>
		<?php pf_core::loadTemplate('header'); ?>
		<style>
                    .online{color:green;}
                    .offline{color:red;}

                    #cpuwrap,#memwrap{color:black;border:1px solid black;width:400px;}
                    
                    #console { white-space: pre; height:300px;overflow:auto;}
                    #chat { white-space: pre; height:300px;overflow:auto;}
                    #errors { white-space: pre; height:300px;overflow:auto;}
                    #connection { white-space: pre; height:300px;overflow:auto;}
                    
                    
                    #multijava{font-size:14px;color:red;}
                    
                    .serverwarning {color:red;}
                    .serverlog{margin-top:25px;}
		</style>
                
		<script>
			$('#tab a').click(function (e) {
  				e.preventDefault();
  				$(this).tab('show');
			})
		
                        //this deals with the CPU/MEM bar
                        function updatestats ()
                        {
                            //grab some general stats from the server
                            $.getJSON('<?php echo pf_config::get('base_url'); ?>index.php/data/general',function(data){
                            
                            //assign some vars based off the data
                            var cores = (data['CORES']); //number of cores on the server
                            var cpu = data['CPU'] / cores;
                            var mem = data['MEM'] ;
                            var multi = data['MULTI'];
                            
                            //if multiple java's are found we show the error
                            if (multi == true){
                                $('#multijava').show();
                            }
                            
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
                            $( "#mem").animate({width: mem*4},500);
                                
                            //change the bar's colors based on new usage (values)'
                            colors("#cpu",cpu);
                            colors("#mem",mem);
                            
                            }); //end main json data call
                            
                            //updates our server logs
                            $('#console').load('<?php echo pf_config::get('main_page')?>/data/mainlog');
                            $('#errors').load('<?php echo pf_config::get('main_page')?>/data/errorlog');
                            $('#chat').load('<?php echo pf_config::get('main_page')?>/data/chatlog');
                            $('#connection').load('<?php echo pf_config::get('main_page')?>/data/connectionlog');
                            
                            //updates player info etc
                            serverinfo();
                            
                            //call yourself again after 10 seconds
                            setTimeout(updatestats,10000);
                        }
                        
                        
                        //makes the menubars pretty (changes color based on load)
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
                        
                        //this collects and reports server data from the minecraft server
                        function serverinfo()
                        {
                            $.getJSON('<?php echo pf_config::get('main_page'); ?>/data/info',function(data){
                                var online = data['online'];
                                
                                $( '#info' ).html ("<b>Craftbukkit Version:</b> "+data['version'] +"<br /><b>Players Connected:</b>"
                                + data['players'] + " of " + data['max_players'] + '<br />' +
                                '<b>MOTD:</b>' + data['motd'] +'<br />')
                                
                                //if online
                                if (online)
                                    {
                                    $('#online').html('Online:Online!')
                                    $('#online').css({'color':'green'});
                                    }
                                else
                                    {
                                    $('#online').html('Online:Offline!')
                                    $('#online').css({'color':'red'});    
                                    }
                            
                            });
                        }
                        
                        //our document is ready, so let's fire off some functions
                        $(document).ready(function(){ 
                            $('#multijava').hide();
                            updatestats();
                            
                        });
                        
                        $(function(){
							$('#test').speedometer();

							$('.changeSpeedometer').click(function(){
								$('#test').speedometer({ percentage: $('.speedometer').val() || 0 });
							});

						});

                        
		</script>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
        <?php pf_core::loadTemplate('menu'); ?>
            <div class="container">
                <h1>Crafty Minecraft Control</h1><hr>
                <div class="row">
                    <div class="span4">
                            <h2>General Info</h2>
                            <div id="online">
                                Online!
                            </div>
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
                            
                            <div id="multijava">
                                Multiple Java's have been found, perhaps you have
                                multiple server running due to an error? You should
                                fix this. Time to break out SSH! <--later we will offer to fix this
                            </div>
                    </div>
                </div>
            </div>
            
            <div class="container serverlog">
            *newest entries at the top*
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#console" data-toggle="tab">All</a></li>
                        <li><a href="#chat" data-toggle="tab">Chat</a></li>
                        <li><a href="#errors" data-toggle="tab">Errors</a></li>
                        <li><a href="#connection" data-toggle="tab">Connections</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="console">
                    
                        </div>
                    <div class="tab-pane" id="chat">
                        <div class="warning">Scheduled for Beta Release</div>
                    </div>
                    <div class="tab-pane" id="errors">
                        <div class="warning">Scheduled for Beta Release</div>
                    </div>
                    <div class="tab-pane" id="connection">
                        <div class="warning">Scheduled for Beta Release</div>
                    </div>
                    </div><!-- END 10 SPAN -->
                </div> <!-- END ROW -->

        <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>