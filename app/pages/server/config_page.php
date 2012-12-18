<html>	
	<head>
		<title>Minecraft Server Control</title>
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
                <script src="<?php echo pf_config::get('base_url'); ?>app/assets/js/main.min.js"></script>
		<link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/main.min.css" rel="stylesheet" media="screen">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/main-responsive.min.css" rel="stylesheet">
                <link href="<?php echo pf_config::get('base_url'); ?>app/assets/css/style.css" rel="stylesheet">
                
                <style>
                    select {width:100px;}
                    input[type=text] {
                       width: 150px;
                    }
                </style>
	</head>
        <body>
            <div class="container-fluid"> <!-- START CONTAINER -->
			<div class="row-fluid">
				<div class="span1"></div>
				<div class="span10">
					<?php pf_core::loadTemplate('menu'); ?>
                                    <h1>Config Your Server</h1>
                                    <p style="color:red;">Currently only letters and number are allowed in text. All spaces/special characters are removed</p>

                                    <form id="form" class= "" action="<?php echo pf_config::get('main_page');?>/server/savesettings" method="POST">                                    
                                        <legend>Common Settings</legend>
                                        <table>
                                            <tr>
                                            <th width="33%">Setting</th>
                                            <th width="33%">New Setting</th>
                                            <th width="33%">Current Setting</th>
                                            </tr>
                                            <tr>
                                                <td>Difficulty: </td>
                                                <td>
                                                    <select name="difficulty">
                                                        <option name="0">Peaceful</option>
                                                        <option name="1">Easy</option>
                                                        <option selected="selected" name="2">Normal</option>
                                                        <option name="3">Hard</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    Currently Set As: <?php echo $data['difficulty']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Game Mode</td>
                                                <td>
                                                    <select name="gamemode">
                                                        <option selected="selected" name="0">Survival</option>
                                                        <option name="1">Creative</option>
                                                        <option name="2">Adventure</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['gamemode']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Hardcore</td>
                                                <td>
                                                    <select name="hardcore">
                                                        <option name="True">True</option>
                                                        <option name="False">False</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['difficulty']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>World</td>
                                                <td><input type="text" name="level-name"  required value="<?php echo $data['level-name']; ?>"/></td>
                                                <td>Currently Set As: <?php echo $data['level-name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Seed</td>
                                                <td><input type="text" name="level-seed"  placeholder="World Seed"/></td>
                                                <td>Currently Set As: <?php echo $data['level-seed']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Max Players</td>
                                                <td><input type="text" name="max-players" required value="<?php echo $data['max-players']; ?>"/></td>
                                                <td>Currently Set As: <?php echo $data['max-players']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>MOTD</td>
                                                <td><input type="text" name="motd"  required value="<?php echo $data['motd']; ?>"/></td>
                                                <td>Currently Set As: <?php echo $data['motd']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>PVP</td>
                                                <td>
                                                    <select name="pvp">
                                                        <option name="True">True</option>
                                                        <option name="False">False</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['pvp']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Spawn Animals</td>
                                                <td>
                                                    <select name="spawn-animals">
                                                        <option name="True">True</option>
                                                        <option name="False">False</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['spawn-animals']; ?></td>
                                            </tr>
                                             <tr>
                                                <td>Spawn Monsters</td>
                                                <td>
                                                    <select name="spawn-monsters">
                                                        <option name="True">True</option>
                                                        <option name="False">False</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['spawn-monsters']; ?></td>
                                            </tr>
                                             <tr>
                                                <td>Spawn NPC's</td>
                                                <td>
                                                    <select name="spawn-npcs">
                                                        <option name="True">True</option>
                                                        <option name="False">False</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['spawn-npcs']; ?></td>
                                            </tr>
                                             <tr>
                                                <td>Texture Pack</td>
                                                <td><input type="text" name="texture-pack" placeholder="Texture Pack URL"/></td>
                                                <td>Currently Set As: <?php echo $data['texture-pack']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>View Distance:</td>
                                                <td>
                                                    <select name="view-distance">
                                                        <option name="3">Close</option>
                                                        <option selected="selected" name="4">4</option>
                                                        <option name="5">5</option>
                                                        <option name="6">6</option>
                                                        <option name="7">7</option>
                                                        <option name="8">8</option>
                                                        <option name="9">9</option>
                                                        <option name="10">Default</option>
                                                        <option name="11">11</option>
                                                        <option name="12">12</option>
                                                        <option name="13">13</option>
                                                        <option name="14">14</option>
                                                        <option name="15">Far</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['view-distance']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><legend>Other Settings</legend></td>
                                            </tr>
                                            <tr>
                                                <td>Allow Flight:</td>
                                                <td>
                                                    <select name="allow-flight">
                                                        <option name="True">True</option>
                                                        <option name="False">False</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['allow-flight']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Enable Query:</td>
                                                <td>
                                                    <select name="enable-query">
                                                        <option name="True">True</option>
                                                        <option name="False">False</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['enable-query']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Enable Rcon:</td>
                                                <td>
                                                    <select name="enable-rcon">
                                                        <option name="True">True</option>
                                                        <option name="False">False</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['enable-rcon']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Enable Command Block:</td>
                                                <td>
                                                    <select name="enable-command-block">
                                                        <option name="True">True</option>
                                                        <option name="False">False</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php if (key_exists('enable-command-block', $data)) echo $data['enable-command-block']; else echo 'No Setting Found'?></td>
                                            </tr>
                                            <tr>
                                                <td>Generate Structures:</td>
                                                <td>
                                                    <select name="generate-structures">
                                                        <option name="True">True</option>
                                                        <option name="False">False</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['generate-structures']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Generator Settings:</td>
                                                <td><input type="text" name="generator-settings" placeholder="Generator Settings"/></td>
                                                <td>Currently Set As: <?php if (key_exists('generator-settings', $data)) echo $data['generator-settings']; else echo 'No Setting Found'?></td>
                                            </tr>
                                            <tr>
                                                <td>Level Type:</td>
                                                <td>
                                                    <select name="level-type">
                                                        <option name="DEFAULT">DEFAULT</option>
                                                        <option name="FLAT">FLAT</option>
                                                        <option name="LARGEBIOMES">LARGEBIOMES</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['level-type']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Max Build Height:</td>
                                                <td><input type="text" name="max-build-height"  required value="<?php echo $data['max-build-height']; ?>"/></td>
                                                <td>Currently Set As: <?php echo $data['max-build-height']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Online Mode:</td>
                                                <td>
                                                    <select name="online-mode">
                                                        <option name="True">True</option>
                                                        <option selected name="False">False</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['online-mode']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Query Port:</td>
                                                <td><input type="text" name="query-port" placeholder="Query Port"/></td>
                                                <td>Currently Set As: <?php if (key_exists('query-port', $data)) echo $data['query-port']; else echo 'No Setting Found'?></td>
                                            </tr>
                                            <tr>
                                                <td>Rcon Password:</td>
                                                <td><input type="text" name="rcon-password" placeholder="rcon password"/></td>
                                                <td>Currently Set As: <?php if (key_exists('rcon-password', $data)) echo $data['rcon-password']; else echo 'No Setting Found'?></td>
                                            </tr>
                                            <tr>
                                                <td>Server IP:</td>
                                                <td><input type="text" name="server-ip" placeholder=""/></td>
                                                <td>Currently Set As: <?php echo $data['server-ip']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Server Port:</td>
                                                <td><input type="text" name="server-port" required value="<?php echo $data['server-port']; ?>"/></td>
                                                <td>Currently Set As: <?php echo $data['server-port']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Scooper Enabled:</td>
                                                <td>
                                                    <select name="scooper-enabled">
                                                        <option name="True">True</option>
                                                        <option name="False">False</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php if (key_exists('scooper-enabled', $data)) echo $data['scooper-enabled']; else echo 'No Setting Found'?></td>
                                            </tr>
                                            <tr>
                                                <td>Spawn Protection:</td>
                                                <td><input type="text" name="spawn-protection"  required value="<?php echo $data['spawn-protection']; ?>"/></td>
                                                <td>Currently Set As: <?php echo $data['spawn-protection']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>White List:</td>
                                                <td>
                                                    <select name="white-list">
                                                        <option name="True">True</option>
                                                        <option name="False" selected>False</option>
                                                    </select>
                                                </td>
                                                <td>Currently Set As: <?php echo $data['white-list']; ?></td>
                                            </tr>
                                         </table>
                                        <input type="submit" value="Save"/>
                                    </form>
                                    </div><!-- END MAIN SPAN -->
				<div class="span1"></div>
			</div><!-- END ROW -->
                        <div class="footer center">
            <?php pf_core::loadTemplate('footer'); ?>
        </div>
		</div><!-- END CONTAINER -->
	</body>
</html>