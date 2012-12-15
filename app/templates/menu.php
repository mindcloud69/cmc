 <?php 
pf_menu::addTopLevel('Home', 'main/index');
pf_menu::addTopLevel('Server Config', 'server/config');
pf_menu::addTopLevel('Players', 'main/players');

if (pf_auth::checkLogin()) pf_menu::addTopLevel('Logout', 'login/logout');
else pf_menu::addTopLevel('Login', 'login');

pf_menu::renderMenu('dropdown dropdown-linear');
?>
