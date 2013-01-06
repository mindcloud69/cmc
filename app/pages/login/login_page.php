<?php
if (key_exists('failed', $data))$failed=true;
else $failed=FALSE;
?>

<html>	
	<head>
		<?php pf_core::loadTemplate('header'); ?>
	</head>
        
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
                                    
            <div id="login">
                <form class="form-signin" id="login" action="<?php echo MAIN_PAGE ?>/login/action" method="POST">
                        
                    <?php if ($failed) echo '<div id="failed" class="alert">Invalid Username/Password Combination</div>'; ?>
                    <legend>Please Login</legend>
                    <center><label for="username">
                        <input type="text" name="username" placeholder="Username" required/>
                    </label></center>
                    <center><label for="password">
                        <input type="password" name="password" placeholder="Password" required />
                    </label></center>
                    <center><input class="button" type="submit" value="Login"/></center>
                    
                </form>
            </div>
        
            <?php pf_core::loadTemplate('footer'); ?>
	</body>
</html>