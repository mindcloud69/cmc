<?php
//get the active URL
$url = $_SERVER['REQUEST_URI'];
$parts = explode('.php', $url);
$page = end($parts);

//check to see if the user is logged in
if (pf_auth::checkLogin()===TRUE) //if logged in, we show a "logout" button
{
    $loginlink = '<a href="'.pf_config::get('base_url').'index.php/login/logout">Logout</a>';
}
else //if not logged in, we show a login link :)
{
    $loginlink = '<a href="'.pf_config::get('base_url').'index.php/login">Login</a>';
}
?>

<div class="navbar"><!--START NAV-->
        <div class="navbar-inner">
                <a class="brand" href="<?php echo pf_config::get('base_url'); ?>index.php">CMC</a>
                <ul class="nav">
                        <li <?php if ($page == '') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('base_url'); ?>index.php">Home</a></li>
                        <li <?php if ($page == '/install') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('base_url'); ?>index.php/install">Install/Config</a></li>
                        <li <?php if ($page == '/login') echo 'class="active"'; ?>> <?php echo $loginlink; ?> </li> <!-- dynamic login/logout link-->
                </ul>
        </div>
</div><!-- END NAV -->