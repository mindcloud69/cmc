<?php
//get the active Controller
$route=pf_config::get('ROUTE');
$page = $route['CONTROLLER'];

//check to see if the user is logged in
if (pf_auth::checkLogin()===TRUE) //if logged in, we show a "logout" button
{
    $loginlink = '<a href="'.pf_config::get('main_page').'/login/logout"><img src="'.pf_config::get('base_url').'/app/assets/site_images/icons/16px/locked.png"/>&nbsp;Logout</a>';
}
else //if not logged in, we show a login link :)
{
    $loginlink = '<a href="'.pf_config::get('main_page').'/login"><img src="'.pf_config::get('base_url').'/app/assets/site_images/icons/16px/locked.png"/>&nbsp;Login</a>';
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
                                    <li id="home"<?php if ($page == 'main') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/icons/16px/home.png"/>&nbsp;Home</a></li>
                                    <li id="install"<?php if ($page == 'install') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/install"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/icons/16px/key.png"/>&nbsp;Install</a></li>
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
                                    <li id="home"<?php if ($page == 'main') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/icons/16px/home.png"/>&nbsp;Home</a></li>

                                    <li id="config"<?php if ($page == 'config') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/config"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/icons/16px/wrench.png"/>&nbsp;Config</a></li>

                                    <li id="server"<?php if ($page == 'server') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/server"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/icons/16px/broadcast.png"/>&nbsp;Server</a></li>
                                    
                                    <li id="backups"<?php if ($page == 'backups') echo 'class="active"'; ?> class="dropdown">
                                        <a href="#" class='dropdown-toggle' data-toggle="dropdown"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/icons/16px/box-add.png"/>&nbsp;Backups<b class="caret"></b></a>
                                        <ul class="dropdown-menu" roll="menu">
                                            <li><a href="<?php echo pf_config::get('main_page');?>/backups">Backups</a></li>
                                            <li><a href="<?php echo pf_config::get('main_page');?>/backups/view">List Backups</a></li>
                                        </ul>
                                    </li>
                                    
                                    <li id="users"<?php if ($page == 'users') echo 'class="active"'; ?> class="dropdown">
                                        <a href="#" class='dropdown-toggle' data-toggle="dropdown"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/icons/16px/user.png"/>&nbsp;Users<b class="caret"></b></a>
                                        <ul class="dropdown-menu" roll="menu">
                                            <li><a href="<?php echo pf_config::get('main_page');?>/users">View Users</a></li>
                                            <li><a href="<?php echo pf_config::get('main_page');?>/users/add">Add User</a></li>
                                        </ul>
                                    </li>
                                    

                                    
                            </ul>
                                    <ul class="nav pull-right">
                                        <li id="settings"<?php if ($page == 'settings') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/settings"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/icons/16px/cog.png"/>&nbsp;CMC Settings</a></li>
                                        <li id="logout"<?php if ($page == 'login') echo 'class="active"'; ?>> <?php echo $loginlink; ?> </li>
                                    </ul>
                                    
                    </div>
            </div><!-- END NAV -->
        </div>


<?php endif;?>
    </div>
</div>