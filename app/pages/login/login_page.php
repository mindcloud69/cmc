<?php
if (key_exists('failed', $data))$failed=true;
else $failed=FALSE;
?>
<!DOCTYPE html>
<html>	
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <style>
                
            </style>
	</head>
        
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            
            <div class="row">
                <?php if ($failed) echo '<div class="row"><div id="failed" class="six offset-by-three alert">Invalid Username/Password Combination</div></div>'; ?>
                
                <div id="login" class="twelve columns centered">
                    
                    <div class="twelve columns centered"><h5 class="center">Please Login</h5></div>
                    
                    <form class="form-signin" id="login" action="<?php echo MAIN_PAGE ?>/login/action" method="POST">
                    
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Username" required/>
                    
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" required />
                    
                    <input class="twelve columns button radius" type="submit" value="Login" />
                    <br />
                </form>
                </div>
            </div>
            
            <?php pf_core::loadTemplate('footer'); ?>
	</body>
</html>