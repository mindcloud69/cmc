<?php
//let's see if they installed the system already? (this data gets passed from the controller)
if ($data['installed'])
{
    $installed = true;
}
else $installed=false;
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
                            <form class="span6 offset3" name="installform" method="POST" action="install/go">
                                    <legend>Administrator Details</legend>
                                    Admin Username<br/><input type="text" name="adminname" placeholder="Admin Username"><br>
                                    Admin Password<br/><input type="text" name="adminpass" placeholder="Password"><br><br>

                                    <legend>Other Details</legend>
                                    Bukkit Location:<br/><input type="text" name="bukkitdir" placeholder="Bukkit Install Directory"><br><br>
                                    <input type="submit" value="SAVE" class="button rounded span2"/>
                            </form>
                    </center>
                </div>
            </div>
        <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>
