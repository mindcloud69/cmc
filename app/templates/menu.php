<?php
//get the active Controller
$route=pf_config::get('ROUTE');
$page = $route['CONTROLLER'];

//check to see if the user is logged in
if (pf_auth::checkLogin()===TRUE) //if logged in, we show a "logout" button
{
    $loginlink = '<a href="'.pf_config::get('main_page').'/login/logout">Logout</a>';
}
else //if not logged in, we show a login link :)
{
    $loginlink = '<a href="'.pf_config::get('main_page').'/login">Login</a>';
}
//check to see if we are installed
$data = new pf_json();
$data->readJsonFile(APPLICATION_DIR.'config'.DS.'settings.json');  //grab data from json
$installed = $data->get('bukkit_dir'); //do we have a bukkit_dir?


?>
<div class="container"> <!-- START CONTAINER -->
    <div class="row">
        <div class="span12">

            <div class="navbar"><!--START NAV-->
                    <div class="navbar-inner">
                            <a class="brand" href="<?php echo pf_config::get('main_page'); ?>">CMC</a>
                            <ul class="nav">
                                    <!--Home-->
                                    <li <?php if ($page == 'main') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>">Home</a></li>

                                    <!--Dynamic Install Link-->
                                    <?php if (!$installed) {?>
                                    <li <?php if ($page == 'install') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/install">Install</a></li>
                                    <?php }?> 

                                    <li <?php if ($page == 'config') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/config">Config</a></li>

                                    <li <?php if ($page == 'server') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/server">Server</a></li>
                                    
                                    <li <?php if ($page == 'backups') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/backups">Backups</a></li>

                                    <li <?php if ($page == 'users') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/users">Users</a></li>

                                    <!--dynamic login link-->
                                    <li <?php if ($page == 'login') echo 'class="active"'; ?>> <?php echo $loginlink; ?> </li>
                            </ul>
                    </div>
            </div><!-- END NAV -->

        </div>
    </div>
</div>