<?php

//check to see if the user is logged in
if (pf_auth::checkLogin()===TRUE) //if logged in, we show a "logout" button
{
    $loginlink = '<a href="'.pf_config::get('main_page').'/login/logout"><img src="'.pf_config::get('base_url').'/app/assets/site_images/used/locked.png"/>&nbsp;Logout '.pf_auth::getVar('user').'</a>';
}
else //if not logged in, we show a login link :)
{
    $loginlink = '<a href="'.pf_config::get('main_page').'/login"><img src="'.pf_config::get('base_url').'/app/assets/site_images/used/locked.png"/>&nbsp;Login</a>';
}
//check to see if we are installed
$data = new pf_json();
$data->readJsonFile(APPLICATION_DIR.'config'.DS.'settings.json');  //grab data from json
$installed = $data->get('bukkit_dir'); //do we have a bukkit_dir?

?>


<?php 
// if not installed we shorten the menu
if (!$installed): ?>
<!-- Top Bar -->
<div class="contain-to-grid">
    <nav class="top-bar"> <!-- Branding -->
        <ul>
            <!-- Title Area -->
            <li class="name">
                <h1>
                  <a href="http://www.craftycontroller.com">CMC</a>
                </h1>
            </li>
            <li class="toggle-topbar"><a href="http://www.craftycontroller.com">CMC</a></li>
        </ul>
        <section>
            <ul class="left">
                <li id="home"<?php if ($page == 'main') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/home.png"/>&nbsp;Home</a></li>
                <li id="install"<?php if ($page == 'install') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/install"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/key.png"/>&nbsp;Install</a></li>
            </ul>
        </section>
    </nav>
</div>
<!-- End Top Bar -->


<?php 
// WE ARE INSTALLED! WOOHOO!
else: ?>
<!-- Top Bar -->
<div class="contain-to-grid">
    <nav class="top-bar"> <!-- Branding -->
        <ul>
            <!-- Title Area -->
            <li class="name">
                <h1>
                  <a href="http://www.craftycontroller.com">CMC</a>
                </h1>
            </li>
            <li class="toggle-topbar"><a href="http://www.craftycontroller.com">CMC</a></li>
        </ul>

    <section>
        <ul class="left">
            
            <li><a href="<?php echo pf_config::get('main_page'); ?>"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/home.png"/>&nbsp;Home</a></li>

            <li class="has-dropdown"><a href="#"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/broadcast.png"/>&nbsp;Server</a>
                <ul class="dropdown">
                    <li><a href="<?php echo pf_config::get('main_page'); ?>/config">Config</a></li>
                    <li><a href="<?php echo pf_config::get('main_page'); ?>/server">Server Commands</a></li>
                    <li><a href="<?php echo pf_config::get('main_page'); ?>/server/update">Update</a></li>
                </ul>
            </li>
            
            <li class="has-dropdown"><a href="#"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/box-add.png"/>&nbsp;Backups</a>
                <ul class="dropdown">
                    <li><a href="<?php echo pf_config::get('main_page');?>/backups">Backups</a></li>
                    <li><a href="<?php echo pf_config::get('main_page');?>/backups/view">List Backups</a></li>
                </ul>
            </li>
        
            <li ><a href="<?php echo pf_config::get('main_page'); ?>/players"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/accessibility.png"/>&nbsp;Players</a></li>
            
            <li class="has-dropdown"><a href="#"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/user.png"/>&nbsp;Users</a>
                <ul class="dropdown">
                    <li><a href="<?php echo pf_config::get('main_page');?>/users">View Users</a></li>
                    <li><a href="<?php echo pf_config::get('main_page');?>/users/add">Add User</a></li>
                    <li><a href="<?php echo pf_config::get('main_page');?>/users/access">Access Control</a></li>
                </ul>
            </li>
        </ul>
    </section>

    <section>
        <ul class="right">
            <li><a href="<?php echo pf_config::get('main_page'); ?>/settings"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/cog.png"/>&nbsp;CMC Settings</a></li>
            <li> <?php echo $loginlink; ?> </li>
        </ul>
    </section>
    </nav>
</div>
<?php endif;?>