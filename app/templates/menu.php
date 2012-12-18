<?php
//get the active URL
$url = $_SERVER['REQUEST_URI']; //grab the URL used
$parts = explode('.php', $url); //explode anything after .php into an array with 2 parts
$page = end($parts);  // basically anything after index.php is our page with a slash in front

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

<div class="navbar"><!--START NAV-->
        <div class="navbar-inner">
                <a class="brand" href="<?php echo pf_config::get('main_page'); ?>">CMC</a>
                <ul class="nav">
                        <!--Home-->
                        <li <?php if ($page == '') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>">Home</a></li>
                    
                        <!--Dynamic Install Link-->
                        <?php if (!$installed) {?>
                        <li <?php if ($page == '/install') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/install">Install</a></li>
                        <?php }?> 
                        
                        <li <?php if ($page == '/server') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/server">Config</a></li>
                        
                        <!--dynamic login link-->
                        <li <?php if ($page == '/login') echo 'class="active"'; ?>> <?php echo $loginlink; ?> </li>

                </ul>
        </div>
</div><!-- END NAV -->