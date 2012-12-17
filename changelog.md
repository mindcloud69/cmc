##Version 1.2.6.a (Build #132)
Added SQLite DB to save users<br />
Added Users list page<br />
Added DB.php to extend PDO to system core (helps with sqlite)<br />
Changed Install to install Admin user to DB<br />

##Version 1.2.5 (Build #130)  - pt
Added better CPU % usage due to server_info reporting number of cores <br />
Added dynamic CPU / MEM bars to main page.<br />
Added dynamic server info (such as version, number of players etc) to main page.<br />
Added data controller to report lots of stuff via json values for jquery in pages.<br />
Added data controller log dump support, will format it later<br />
<br />
Fixed Server_conf lib not reporting plugins<br />
Fixed Server_conf lib not reporting essentials properly<br />
Fixed Main Controller to report plugins properly.<br />
<br />
Changed License to Attribution-ShareAlike 3.0 Unported <br />
Changed main controller to redirect the user to the installer if no settings file found.<br />
<br />
## Version 1.2.5 (Build #115)
Installer fixes.<br />
Menu fixes.<br />
General CSS stuff.<br />
As usually, I added some random CSS possibly usable in the future.<br />
Added potential logo to app/assets/favicon.gif.<br />
<br />
## Version 1.2.4 (Build #112)
Added Menu Template with dynamic login/logout and active links<br />
Added pages/install/complete_page.php<br />
Added Admin/User seperation in settings.json<br />
Added Footer Template to pages<br />
Added new login page with form<br />
Added pages/main_page.php to include some variables from config (finally!)<br />
Added controller logic in main controller to pull some info from the server_conf class<br />
<br />
Changed login logic to check settings.json not the temp users array<br />
Changed pf_auth::checkLogin to report true/false<br />
<br />
Fixed ability to pass data to pages from controller<br />
Fixed form errors on pages/install/install_page.php<br />
<br />
Removed temp users array from config file<br />
<br />
## Version 1.2.3 (Build #89)
New server config screen and styles added. Not fully complete. Started adding build (commit) numbers to changelog. Minor bug fixes.
<br />
## Version 1.2.1
Slight changes in the install screen.
<br />
## Version 1.2
Interface overhaul! New menu, tabs, and RAM/CPU bars. Finally, I got get a menu that looks decent. Just need to add the PHP variables. (1001zippy)
<br />
## Version 1.1
Whole system rebuilt. New controller, and view system. (ptarrant)
<br />
## Version 1.0
Initial Commit (ptarrant)
