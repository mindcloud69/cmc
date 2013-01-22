<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">World Management</h3>
                        
            <div class="row">
                <div class="ten columns centered panel">
                    <h5 class="center">Schedule Backup for <?php echo $data['name'] ?></h5>
                    <?php
                    
                    pf_forms::createForm('schedule', 'six columns centered', MAIN_PAGE."/backups/schedule", 'POST');
                    
                    $times = array(
                        '0'=>'12am',
                        '1'=>'1am',
                        '2'=>'2am',
                        '3'=>'3am',
                        '4'=>'4am',
                        '5'=>'5am',
                        '6'=>'6am',
                        '7'=>'7am',
                        '8'=>'8am',
                        '9'=>'9am',
                        '10'=>'10am',
                        '11'=>'11am',
                        '12'=>'12pm',
                        '13'=>'1pm',
                        '14'=>'2pm',
                        '15'=>'3pm',
                        '16'=>'4pm',
                        '17'=>'5pm',
                        '18'=>'6pm',
                        '19'=>'7pm',
                        '20'=>'8pm',
                        '21'=>'9pm',
                        '22'=>'10pm',
                        '23'=>'11pm'
                    );?>
                    
                    Backup every day at <?php pf_forms::options('hour', 'hour' ,$times);?><br />
                    <?php pf_forms::button('submit', 'Schedule it!', 'button rounded twelve');?>
                    <?php pf_forms::hidden('command', '/usr/bin/wget -q -O /tmp/cmc-backup http://localhost/index.php/backups/scheduled?dir='.$data['dir'].'&name='.$data['name']); ?>
                    <?php pf_forms::hidden('world', $data['name']); ?>
                    <?php pf_forms::closeForm();
                    ?>
                </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>

