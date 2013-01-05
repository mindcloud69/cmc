<?php
//let's see if they installed the system already? (this data gets passed from the controller)
if ($data['installed'])
{
    $installed = true;
}
else $installed=false;

$loglines = array(
    '100'=>'100',
    '200'=>'200',
    '300'=>'300',
    '400'=>'400',
    '500'=>'500',
    '600'=>'600',
    '700'=>'700',
    '800'=>'800',
    '900'=>'900',
    '1000'=>'1000',
);
?>


<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script>
			$('#tab a').click(function (e) {
  				e.preventDefault();
  				$(this).tab('show');
			})
		
			$(".alert").alert()
		</script>
	</head>
	<body>
            <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">Install Crafty Minecraft Controller</h3>
                        
            <div class="container">
                <div class="row">
                    <?php if ($installed){?>
                        <div class="alert span6 offset3">
                                <h3>Oh SNAP - you've already installed CMC!</h3>
                                <p class="center">
                                It's OK, don't panic, we can get through this together.<br />
                                <a href="<?php echo pf_config::get('main_page');?>">CLICK HERE TO ABORT!</a>
                                <br />
                                OR<br />
                                Ignore this message and continue filling out the form to reinstall.
                                </p>
                        </div>
                    <?php }?>
                    
                    <center>
                        <?php pf_forms::createForm('install', 'span6 offset3', pf_config::get('main_page').'/install/go', 'POST');?>
                        <legend>Administrator Details</legend>
                        Admin Username<br /><?php pf_forms::text('adminname', true, null, 'Admin Username');?><br />
                        Admin Password<br /><?php pf_forms::text('adminpass', true, null, 'Admin Password');?><br />
                        <legend>Other Details</legend>
                        Bukkit Location:<br /><?php pf_forms::text('bukkitdir', true, null, 'Bukkit Install Directory');?><br />
                        Bukkit Release Channel<br /><?php pf_forms::options('bukkitchannel', 'bukkitchannel', array('Recommeded'=>'Recommended','Beta'=>'Beta','Dev'=>'Dev')); ?><br />
                        <input type="checkbox" value="stats" checked />Send Install Stats<br />
                        <br />
                        <input type="submit" value="SAVE" class="button rounded span2"/>
                        <?php pf_forms::closeForm();?>
                    </center>
                </div>
            </div>
        <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>
