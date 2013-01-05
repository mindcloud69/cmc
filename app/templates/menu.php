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

<?php 
// if not installed we shorten the menu
if (!$installed): ?>

        <div class="span12">

            <div class="navbar"><!--START NAV-->
                    <div class="navbar-inner">
                            <a class="brand" href="http://www.craftycontroller.com">CMC</a>
                            <ul class="nav">
                                    <!--Home-->
                                    <li <?php if ($page == 'main') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>">Home</a></li>
                                    <li <?php if ($page == 'install') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/install">Install</a></li>
                            </ul>
                    </div>
            </div><!-- END NAV -->
        </div>

<?php 
// WE ARE INSTALLED! WOOHOO!
else: ?>

        <div class="span12">

            <div class="navbar"><!--START NAV-->
                    <div class="navbar-inner">
                        
                            <a class="brand" href="http://www.craftycontroller.com">CMC</a>
                            <ul class="nav">
                                    <!--Home-->
                                    <li <?php if ($page == 'main') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>">Home</a></li>

                                    <li <?php if ($page == 'config') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/config">Config</a></li>

                                    <li <?php if ($page == 'server') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/server">Server</a></li>
                                    
                                    <li <?php if ($page == 'backups') echo 'class="active"'; ?> class="dropdown">
                                        <a href="#" class='dropdown-toggle' data-toggle="dropdown">Backups<b class="caret"></b></a>
                                        <ul class="dropdown-menu" roll="menu">
                                            <li><a href="<?php echo pf_config::get('main_page');?>/backups">Backups</a></li>
                                            <li><a href="<?php echo pf_config::get('main_page');?>/backups/view">List Backups</a></li>
                                        </ul>
                                    </li>
                                    
                                    <li <?php if ($page == 'users') echo 'class="active"'; ?> class="dropdown">
                                        <a href="#" class='dropdown-toggle' data-toggle="dropdown">Users<b class="caret"></b></a>
                                        <ul class="dropdown-menu" roll="menu">
                                            <li><a href="<?php echo pf_config::get('main_page');?>/users">View Users</a></li>
                                            <li><a href="<?php echo pf_config::get('main_page');?>/users/add">Add User</a></li>
                                        </ul>
                                    </li>
                                    

                                    
                            </ul>
                                    <ul class="nav pull-right">
                                        <li <?php if ($page == 'settings') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/settings">CMC Settings</a></li>
                                        <li <?php if ($page == 'login') echo 'class="active"'; ?>> <?php echo $loginlink; ?> </li>
                                    </ul>
                                    
                    </div>
            </div><!-- END NAV -->
        </div>


<?php endif;?>
    </div>
</div>