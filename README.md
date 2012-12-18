Crafty-Minecraft-Controller
===========================
*A Completely OPEN SOURCE Server Controller for Bukkit (or Minecraft)*<br />
[ChangeLog -->](https://github.com/ptarrant/cmc/blob/master/changelog.md)


##Requirements
This system requires the following:
Apache Version: 2.2.20 (default on ubuntu)
PHP Version 5.3.6 (default on ubuntu)
SQLite 3 Support

###fresh install help
If doing a fresh install on ubuntu you can select the LAMP setup config, or

* sudo apt-get install apache2

* sudo apt-get install php5

* sudo apt-get install libapache2-mod-php5

* sudo apt-get install php5-sqlite

* sudo /etc/init.d/apache2 restart

* Currently to save data www-data must have access to /var/www and the dir bukkit is installed to.
    * chown -R www-data /var/www
    * chown -R www-data /bukkit (or where ever bukkit is installed)

##Todo List
 **ptarrant**
 * save Server.properties file via the form
 * Op/Kick/Ban players
 * Split server.log into [info] and chat
 * color chat messages and remove the color format from log output
 * Manage Backup/Server_Check/Server_Restart Script Schedules
 * Manage Backups and Schedule them.

**Zippy**
 * Read all the emails p.t. sent me :D
 * Put PHP variables in main view
 * Config forms
 * ~~Login forms~~
 * ~~Setup forms~~
 * Style the config page
 * Work on learning PHP
 * Ban/OP/Kick buttons
 * General interface improvement

**Done**
 * General prettiness
 * New PHP system
 * Menu's redone with templates
 * Setup Login
 * Login System
 * SQLite for storage of Users
 * General Server Info delivered via JSON
 * Login forms
 


##License / Copyright

Copyright (c) 2012, Phillip Tarrant and Noah Rossi
All rights reserved.

License: http://creativecommons.org/licenses/by-sa/3.0/legalcode

 
