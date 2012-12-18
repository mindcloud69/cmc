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


//links are as so:
//basically $page will be == to anything after index.php so if there is nothing after it, it's the home page
//if there is /install after index.php then $page will be /install
//if the page == the condition, it echos (prints) the 'class=active' inside the <li> tag. :)
?>

<div class="navbar"><!--START NAV-->
        <div class="navbar-inner">
                <a class="brand" href="<?php echo pf_config::get('base_url'); ?>index.php">CMC</a>
                <ul class="nav">
                        <li <?php if ($page == '') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>">Home</a></li>
                        <li <?php if ($page == '/install') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/install">Install</a></li>
                        <li <?php if ($page == '/server') echo 'class="active"'; ?> ><a href="<?php echo pf_config::get('main_page'); ?>/server">Config</a></li>
                        <li <?php if ($page == '/login') echo 'class="active"'; ?>> <?php echo $loginlink; ?> </li> <!-- dynamic login/logout link-->
                </ul>
        </div>
</div><!-- END NAV -->