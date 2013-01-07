<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
        <body>
            <?php pf_core::loadTemplate('menu'); ?>

            <div class="container">
                <div class="row">
                    <div class="span6 offset3">
                        <h3 class="center">Banned Players</h3>
                        <hr>
                        <h3 class="center">Woot! CMC is now installed!</h3>
                        <p>I know, it's really exciting. Look, there's even a menu at the top. 
                            Feel free to play around with it. To start, click the "Home" button to 
                            begin managing your server with ease.
                        </p>

                    </div>
                </div>
            </div><!-- END CONTAINER -->
	</body>
</html>

<?php
$table = new pf_tables();
$table->startTable('bannedplayers', null, null, 'table tablestripped');
$table->startRow();
$table->addCell('Player');
$table->addCell('Banned Since');
$table->endRow();


foreach ($data as $info)
{
    
    $table->startRow();
    $table->addCell($info['player']);
    $table->addCell($info['since']);
    $table->endRow();
}

$table->renderTable();

?>
