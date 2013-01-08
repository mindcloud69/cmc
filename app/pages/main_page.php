<?php
//convert to string
if ($data['current_cron'])
    $data['current_cron'] = 'TRUE';
else $data['current_cron'] = 'FALSE';
?>

<!DOCTYPE html>
<html>
	<head>
		<?php pf_core::loadTemplate('header'); ?>
            
                <script type="text/javascript" src="http://jsgauge.googlecode.com/svn/trunk/src/gauge.js"></script>
                <script type="text/javascript" src="http://jsgauge.googlecode.com/svn/trunk/src/jquery.gauge.js"></script>
		
                <style>
                    .online{color:green;}
                    .offline{color:red;}

                    #console { white-space: pre; height:300px;overflow:auto;}
                    #chat { white-space: pre; height:300px;overflow:auto;}
                    #errors { white-space: pre; height:300px;overflow:auto;}
                    #connection { white-space: pre; height:300px;overflow:auto;}
                    
                    
                    #multijava{font-size:14px;color:red;}
                    
                    .serverwarning {color:red;}
                    .serverlog{margin-top:25px;}
                    
                    .box{border:1px solid #aaa; padding:5px;}
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
                            
                            $( "#cores").html('CPU Usage Based On '+ cores +' Cores');
                            
                            
                            //change the bar's width based on cpu and core
                            if (cores = 1)
                                {
                                    $('#cpu').gauge('setValue', cpu);
                                }
                            else if (cores = 2)
                                {
                                    $('#cpu').gauge('setValue', cpu / 2);
                                        
                                    //$( "#cpu").animate({height: cpu },500);
                                }
                            else if (cores = 4)
                                {
                                    $('#cpu').gauge('setValue', cpu / 4);
                                }
                            else if (cores = 8)
                                {
                                    $('#cpu').gauge('setValue', cpu / 8);
                                }
                                
                            //same with mem usage                                
                            $('#mem').gauge('setValue', mem);    
                            //$( "#mem").animate({height: mem*4},500);
                                
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
                                
                                $( '#info' ).html (
                                "<b>Craftbukkit Version:</b> " +data['version'] +"<br />\n\
                                <b>Players Connected:</b> " + data['players'] + " of " + data['max_players'] + '<br />'
                                + '<b>MOTD:</b> ' + data['motd'] +'<br />')
                                
                                //if online
                                if (online)
                                    {
                                    $('#online').html('<b>Online-Status</b>:Online!')
                                    $('#online').css({'color':'green'});
                                    }
                                else
                                    {
                                    $('#online').html('<b>Online-Status</b>:Offline!')
                                    $('#online').css({'color':'red'});    
                                    }
                            
                            });
                        }
                        
                        //our document is ready, so let's fire off some functions
                        $(document).ready(function(){ 
                            $('#multijava').hide();
                            updatestats();
                            
                           $("#cpu")
                          .gauge({
                             colorOfCenterCircleFill:'#000000',//center of needle
                             colorOfCenterCircleStroke:'#000000',//outline of center
                             colorOfPointerFill:'#000000',//color of needle
                             colorOfPointerStroke:'#000000',//outline of needle
                             unitsLabel: '%',
                             majorTicks:10,
                             minorTicks:1, //number of ticks between major ticks
                             min: 0,
                             max: 100,
                             label: 'CPU',
                             bands: [
                                 {color: "#ffff00", from: 50, to: 74},
                                 {color: "#ff0000", from: 75, to: 100}
                                 ]
                           })
                           
                           $("#mem")
                          .gauge({
                             colorOfCenterCircleFill:'#000000',//center of needle
                             colorOfCenterCircleStroke:'#000000',//outline of center
                             colorOfPointerFill:'#000000',//color of needle
                             colorOfPointerStroke:'#000000',//outline of needle
                             unitsLabel: '%',
                             majorTicks:10,
                             minorTicks:1, //number of ticks between major ticks
                             min: 0,
                             max: 100,
                             label: 'MEM',
                             bands: [
                                 {color: "#ffff00", from: 50, to: 74},
                                 {color: "#ff0000", from: 75, to: 100}
                                 ]
                           })
                           
                          
                        });
		</script>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
        <?php pf_core::loadTemplate('menu'); ?>
            <div class="container">
                <div class="row">
                    <h1 class="center">CMC Server Overview</h1>
                    <div class="span12">

                        <div id="gauges" class="span6">
                                <h4 class="center">Server Load</h4>
                                <p id='cores' class="center">CPU Usage Based On X Cores</p>
                                <canvas id="cpu" class="span2 offset1" height="300"></canvas>
                                <canvas id="mem" class="span2" height="300"></canvas>
                                <br style="clear:both;"/>
                                <div id="info" class="center">&nbsp;</div>
                        </div>

                        <div class="span4" >
                            <h4 class="center">Quick Stats:</h4>
                            <div id="online">Online!</div>
                            <strong>Auto-Restart:</strong>  <?php echo $data['current_cron'];?><br>
                            <strong>Last Backup:</strong>  Differed to Beta<br>
                            <strong>Next Backup:</strong>  Differed to Beta<br>
                            <br />
                            <strong>Difficulty:</strong> <?php echo $data['difficulty'];?><br>
                            <strong>PvP:</strong><?php echo $data['pvp'];?><br>
                            <strong>Game Type:</strong> <?php echo $data['gamemode'];?><br>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div id="multijava" class="span10 offset1">
                        Multiple Java's have been found, perhaps you have
                        multiple server running due to an error? You should
                        fix this. Time to break out SSH! <--later we will offer to fix this
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