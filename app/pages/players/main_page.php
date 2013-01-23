<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
        <body>
            <?php pf_core::loadTemplate('menu'); ?>

                    <h3 class="center">Player Management</h3>
                    <div class="row">
                        <div class="ten columns offset-by-one">
                            <div id="banned" class="twelve columns">
                                <h4 class="center">All Players for World:<?php echo $data['world']; ?></h4>
                                <?php
                                $table = new pf_tables();
                                $table->startTable('players', null, null, 'table tablestripped twelve');
                                $table->startRow();
                                $table->addTableHeading('Player');
                                $table->addTableHeading('Last Seen');
                                $table->addTableHeading('Delete');
                                $table->endRow();

                                foreach ($data['players'] as $info)
                                {
                                    $table->startRow();
                                    $table->addCell($info['name']);
                                    $table->addCell($info['last_seen']);
                                    $table->addCell('<a class="alert eight offset-by-two button rounded" href="'.MAIN_PAGE.'/players/delete?name='.$info['name'].'">Delete Players File</a>',null,'center');
                                    $table->endRow();
                                }
                                $table->renderTable();
                                ?>
                            </div>
                        </div>
                        
                    </div>        
                <div class="row">
                    <div class="twelve columns">
                        <div id="banned" class="four columns">
                            <h4 class="center">Banned Players</h4>
                            <?php
                            $table = new pf_tables();
                            $table->startTable('bannedplayers', null, null, 'table twelve columns tablestripped');
                            $table->startRow();
                            $table->addTableHeading('Player');
                            $table->addTableHeading('Banned Since');
                            $table->endRow();


                            foreach ($data['banned'] as $info)
                            {
                                $table->startRow();
                                $table->addCell($info['player']);
                                $table->addCell($info['since']);
                                $table->endRow();
                            }

                            $table->renderTable();

                            ?>
                        </div>
                        
                        <div id="banned" class="four columns">
                            <h4 class="center">Banned IP Addresses</h4>
                            <?php
                            $table = new pf_tables();
                            $table->startTable('bannedips', null, null, 'table twelve columns tablestripped');
                            $table->startRow();
                            $table->addTableHeading('IP');
                            $table->addTableHeading('Banned Since');
                            $table->endRow();


                            foreach ($data['bannedips'] as $info)
                            {

                                $table->startRow();
                                $table->addCell($info['IP']);
                                $table->addCell($info['since']);
                                $table->endRow();
                            }

                            $table->renderTable();

                            ?>
                        </div>
                        
                        <div id="ops" class="four columns">
                            <h4 class="center">OP'ed Players</h4>
                            <?php
                            $table = new pf_tables();
                            $table->startTable('ops', null, null, 'table twelve columns tablestripped');
                            $table->startRow();
                            $table->addTableHeading('Player');
                            $table->endRow();
                            
                            foreach ($data['ops'] as $player)
                            {
                                $table->startRow();
                                $table->addCell($player);
                                $table->endRow();
                            }
                            $table->renderTable();
                        ?>
                        </div>
                    </div>
                </div>
	</body>
</html>

