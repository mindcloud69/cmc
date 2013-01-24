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

                    #mainlog,#errorlog,#chatlog,#connlog,#cmclog { white-space: pre; height:350px;overflow:auto;margin-top:0px;padding-top: 0px;}
                    
                    #multijava{font-size:14px;color:red;}
                    
                    .serverwarning {color:red;}
                    .serverlog{margin-top:25px;}
                    
                    .button-group{background:none;}
                    #filters{margin:0px;}
                    
		</style>
		<script>
			/*$('#tab a').click(function (e) {
  				e.preventDefault();
  				$(this).tab('show');
			})*/
		
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
                                
                            }); //end main json data call
                            
                            //updates player info etc
                            serverinfo();
                            
                            //update logs
                            $('#mainlog').load('<?php echo MAIN_PAGE;?>/data/mainlog');
                            $('#chatlog').load('<?php echo MAIN_PAGE;?>/data/chatlog');
                            $('#errorlog').load('<?php echo MAIN_PAGE;?>/data/errorlog');
                            $('#connlog').load('<?php echo MAIN_PAGE;?>/data/connectionlog');
                            $('#cmclog').load('<?php echo MAIN_PAGE;?>/data/cmclog');
                            
                            //call yourself again after 10 seconds
                            setTimeout(updatestats,10000);
                        }
                        
                        
                        //this collects and reports server data from the minecraft server
                        function serverinfo()
                        {
                            $.getJSON('<?php echo pf_config::get('main_page'); ?>/data/info',function(data){
                                var online = data['online'];
                                
                                $( '#info' ).html (
                                "<b>Server Version:</b> " +data['version'] +"<br />\n\
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
                            
                            //show the main log but hide others
                                $('#mainlog').show();
                                $('#errorlog').hide();
                                $('#connlog').hide();
                                $('#chatlog').hide();
                                $('#cmclog').hide();
                            
                            //on chat click
                            $('#chat').click(function() {
                                $('#mainlog').hide();
                                $('#errorlog').hide();
                                $('#connlog').hide();
                                $('#chatlog').show();
                                $('#cmclog').hide();
                                
                            });
                            
                            //on all click
                            $('#all').click(function() {
                                //$('#logload').load ('<?php echo MAIN_PAGE;?>/data/mainlog');
                                 $('#mainlog').show();
                                $('#errorlog').hide();
                                $('#connlog').hide();
                                $('#chatlog').hide();
                                $('#cmclog').hide();
                            });
                            
                            //on errors click
                            $('#errors').click(function() {
                                //$('#logload').load ('<?php echo MAIN_PAGE;?>/data/errorlog');
                                $('#mainlog').hide();
                                $('#errorlog').show();
                                $('#connlog').hide();
                                $('#chatlog').hide();
                                $('#cmclog').hide();
                                
                            });
                            
                            //on connections click
                            $('#connections').click(function() {
                                //$('#logload').load ('<?php echo MAIN_PAGE;?>/data/connectionlog');
                                $('#mainlog').hide();
                                $('#errorlog').hide();
                                $('#connlog').show();
                                $('#chatlog').hide();
                                $('#cmclog').hide();
                            });
                            
                            //on cmc click
                            $('#cmc').click(function() {
                                //$('#logload').load ('<?php echo MAIN_PAGE;?>/data/cmclog');
                                $('#mainlog').hide();
                                $('#errorlog').hide();
                                $('#connlog').hide();
                                $('#chatlog').hide();
                                $('#cmclog').show();
                            });
                            
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
            <!-- Content -->
                <div class="row">
                    <div id="multijava" class="twelve columns alert warning">
                        Multiple Java's have been found, perhaps you have
                        multiple server running due to an error? You should
                        fix this. Time to break out SSH! <--later we will offer to fix this
                    </div>
                </div>
            
                <div class="row">
                    <div class="twelve columns offset-by-three">
                            <h2 >CMC Server Overview</h2>
                    </div>
                </div>
            
                <div class="row">
                    <div class="twelve columns">

                        <div id="gauges" class="eight columns">
                                <h4 class="six columns centered offset-by-four">Server Load</h4>
                                
                                <div class="row">
                                    <div class="eight columns centered">
                                        <canvas id="cpu" height="180" width="180"></canvas>
                                        <canvas id="mem" height="180" width="180"></canvas>
                                    </div>
                                </div>
                                <p id='cores' class="twelve columns"style="text-align:center;">CPU Usage Based On X Cores</p>
                        </div>

                        <div class="four columns panel">
                            <h4 class="center">Quick Stats:</h4>
                            <div id="online">Online!</div>
                            <strong>Auto-Restart:</strong>  <?php echo $data['current_cron'];?><br>
                            <strong>Last Backup:</strong>  Differed to Beta<br>
                            <strong>Next Backup:</strong>  Differed to Beta<br>
                            <br />
                            <strong>Difficulty:</strong> <?php echo $data['difficulty'];?><br>
                            <strong>PvP:</strong><?php echo $data['pvp'];?><br>
                            <strong>Game Type:</strong> <?php echo $data['gamemode'];?><br>
                            <br />
                            <div id="info">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <br />
                
                <!---LOG BUTTONS-->
                <h4 class="center" style="margin:2px;padding: 0px;">Server Logs</h4>
            <div class="row">
                <div class="twelve columns">
                    <ul id="filters" class="button-group even five-up">
                      <li id="all"><a href="#" class="button secondary">All Messages</a></li>
                      <li id="chat"><a href="#" class="button secondary">Chat Only</a></li>
                      <li id="errors"><a href="#" class="button secondary">Errors Only</a></li>
                      <li id="connections"><a href="#" class="button secondary">Connections</a></li>
                      <li id="cmc"><a href="#" class="button secondary">CMC Actions</a></li>
                    </ul>
                    
                    <!---LOG DIVS-->
                    <div id="mainlog" class="twelve columns panel"></div>
                    <div id="chatlog" class="twelve columns panel"></div>
                    <div id="errorlog" class="twelve columns panel"></div>
                    <div id="connlog" class="twelve columns panel"></div>
                    <div id="cmclog" class="twelve columns panel"></div>
                    <p class="center" style="color:red;margin:0px;padding:0px;">**Refreshes every 10 seconds**</p>
                    
                </div>
            </div>

        <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>