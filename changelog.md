##Version 1.2.5 (Build #118)  - pt
Added better CPU % usage due to server_info reporting number of cores 
Added dynamic CPU / MEM bars to main page.
Added dynamic server info (such as version, number of players etc) to main page.
Added data controller to report lots of stuff via json values for jquery in pages.
Added data controller log dump support, will format it later

Fixed Server_conf lib not reporting plugins
Fixed Server_conf lib not reporting essentials properly
Fixed Main Controller to report plugins properly.

Changed License to Attribution-ShareAlike 3.0 Unported 
Changed main controller to redirect the user to the installer if no settings file found.

## Version 1.2.5 (Build #115)
Installer fixes.<br />
Menu fixes.<br />
General CSS stuff.<br />
As usually, I added some random CSS possibly usable in the future.<br />
Added potential logo to app/assets/favicon.gif.

## Version 1.2.4 (Build #112)
Added Menu Template with dynamic login/logout and active links
Added pages/install/complete_page.php
Added Admin/User seperation in settings.json
Added Footer Template to pages
Added new login page with form
Added pages/main_page.php to include some variables from config (finally!)
Added controller logic in main controller to pull some info from the server_conf class

Changed login logic to check settings.json not the temp users array
Changed pf_auth::checkLogin to report true/false

Fixed ability to pass data to pages from controller
Fixed form errors on pages/install/install_page.php

Removed temp users array from config file

## Version 1.2.3 (Build #89)
New server config screen and styles added. Not fully complete. Started adding build (commit) numbers to changelog. Minor bug fixes.

## Version 1.2.1
Slight changes in the install screen.

## Version 1.2
Interface overhaul! New menu, tabs, and RAM/CPU bars. Finally, I got get a menu that looks decent. Just need to add the PHP variables. (1001zippy)

## Version 1.1
Whole system rebuilt. New controller, and view system. (ptarrant)

## Version 1.0
Initial Commit (ptarrant)
