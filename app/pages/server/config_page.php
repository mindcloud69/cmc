<html>	
	<head>
		<title>Minecraft Server Control</title>
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
                <script src="<?php echo pf_config::get('base_url'); ?>app/assets/js/main.min.js"></script>
		<link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/main.min.css" rel="stylesheet" media="screen">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/main-responsive.min.css" rel="stylesheet">
                <link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/style.css" rel="stylesheet">
	</head>
        <body>
            <div class="container-fluid"> <!-- START CONTAINER -->
			<div class="row-fluid">
				<div class="span1"></div>
				<div class="span10">
					<?php pf_core::loadTemplate('menu'); ?>
                                    <h1>Config Your Server</h1>
<?php

//zippy replace push_3 grid_6 with any classes you want applied to the form.
pf_forms::createForm('form', 'push_3 grid_6', pf_config::get('base_url').'/server/config/go', 'POST');

echo '<h1>Common Settings</h1>';
pf_forms::Options('Difficulty', 'Difficulty',array('0'=>'Peaceful','1'=>'Easy','2'=>'Normal','3'=>'Hard'),server_conf::getSetting('difficulty'));
pf_forms::Options('GameMode', 'GameMode',array('0'=>'Survival','1'=>'Creative','2'=>'Adventure'),server_conf::getSetting('gamemode'));
pf_forms::Options('Hardcore', 'Hardcore',array('True'=>'True','False'=>'False'),server_conf::getSetting('hardcore'));
pf_forms::Text('World', 'World', null, server_conf::getSetting('level-name'));
pf_forms::Text('Seed', 'Seed', null, server_conf::getSetting('seed'));
pf_forms::Text('Max_Players', 'Max Players', null, server_conf::getSetting('max-players'));
pf_forms::Text('MOTD', 'Message Of The Day', null, server_conf::getSetting('motd'));
pf_forms::Options('PVP', 'PVP', array('True'=>'True','False'=>'False'), server_conf::getSetting('pvp'));
pf_forms::Options('Spawn_Animals', 'Spawn Animals',array('True'=>'True','False'=>'False'),server_conf::getSetting('spawn-animals'));
pf_forms::Options('Spawn_Monsters', 'Spawn Monsters',array('True'=>'True','False'=>'False'),server_conf::getSetting('spawn-monsters'));
pf_forms::Options('Spawn_NPCs', 'Spawn NPCs',array('True'=>'True','False'=>'False'),server_conf::getSetting('spawn-npcs'));
pf_forms::Text('Texture_Pack', 'Texture-Pack', null, server_conf::getSetting('texture-pack'));
pf_forms::Options('View_Distance', 'View Distance',array('3'=>'Close','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'Default','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'Far'),server_conf::getSetting('view-distance'));


echo '<h1>Other Settings</h1>';
pf_forms::Options('Allow_Flight', 'Allow Flight', array('True'=>'True','False'=>'False'), server_conf::getSetting('allow-flight'));
pf_forms::Options('Allow_Nether', 'Allow Nether', array('True'=>'True','False'=>'False'), server_conf::getSetting('allow-nether'));
pf_forms::Options('Enable_Query', 'Enable Query', array('True'=>'True','False'=>'False'), server_conf::getSetting('enable-query'));
pf_forms::Options('Enable_Rcon', 'Enable Rcon', array('True'=>'True','False'=>'False'), server_conf::getSetting('enable-rcon'));
pf_forms::Options('Enable_Command_Block', 'Enable Command Block', array('True'=>'True','False'=>'False'), server_conf::getSetting('enable-command-block'));
pf_forms::Options('Generate_Structures', 'Generate Structures',array('True'=>'True','False'=>'False'),server_conf::getSetting('generate-structures'));
pf_forms::Text('Generator_Settings', 'Generator Settings', null, server_conf::getSetting('generator-settings'));
pf_forms::Options('Level_Type', 'Level Type',array('DEFAULT'=>'DEFAULT','FLAT'=>'FLAT','LARGEBIOMES'=>'LARGEBIOMES'),server_conf::getSetting('generate-structures'));
pf_forms::Text('Max_Build_Height', 'Max Build Height', null, server_conf::getSetting('max-build-height'));
pf_forms::Options('Online_Mode', 'Online Mode',array('True'=>'True','False'=>'False'),server_conf::getSetting('online-mode'));
pf_forms::Text('Query_Port', 'Query Port', null, server_conf::getSetting('query.port'));
pf_forms::Text('Rcon_Password', 'Rcon Password', null, server_conf::getSetting('rcon.password'));
pf_forms::Text('Server_IP', 'Server IP', null, server_conf::getSetting('server-ip'));
pf_forms::Text('Server_Port', 'Server Port', null, server_conf::getSetting('server-port'));
pf_forms::Options('Scooper_Enabled', 'Scooper Enabled',array('True'=>'True','False'=>'False'),server_conf::getSetting('scooper-enabled'));
pf_forms::Text('Spawn_Protection', 'Spawn Protection', null, server_conf::getSetting('spawn-protection'));
pf_forms::Options('White_List', 'Whitelist',array('True'=>'True','False'=>'False'),server_conf::getSetting('white-list'));


pf_forms::Button('Button','Save');



?>

</div><!-- END MAIN SPAN -->
				<div class="span1"></div>
			</div><!-- END ROW -->
                        <div class="footer center">
            <?php pf_core::loadTemplate('footer'); ?>
        </div>
		</div><!-- END CONTAINER -->
	</body>
</html>