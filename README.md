Crafty-Minecraft-Controller
===========================
*A Completely OPEN SOURCE Server Controller for Bukkit (or Minecraft)*



##Requirements
This system requires the following:
Apache Version: 2.2.20 (default on ubuntu)
PHP Version 5.3.6 (default on ubuntu)


###fresh install help
If doing a fresh install on ubuntu you can select the LAMP setup config, or

* sudo apt-get install apache2

* sudo apt-get install php5

* sudo apt-get install libapache2-mod-php5

* sudo /etc/init.d/apache2 restart

* Currently to save data www-data must have access to /var/www and the dir bukkit is installed to.
    * chown -R www-data /var/www
    * chown -R www-data /bukkit (or where ever bukkit is installed)

##Todo List
 * Save/Read Logins to JSON file
 * Finish porting over old repo to this one (with no need for mod_rewrite)
 * save Server.properties file via the form
 * Op/Kick/Ban players
 * Auto-Install Script!!!
 * More Error checking if /bukkit info not found etc...
 * Split server.log into [info] and chat
 * color chat messages and remove the color format from log output
 * ~~Prettiness :P~~ (Zippy's says- done!)
 * Manage Backup/Server_Check/Server_Restart Script Schedules
 * Manage Backups and Schedule them.


##License / Copyright

Copyright (c) 2012, Phillip Tarrant and Noah Rossi
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met: 

1. Redistributions of source code must retain the above copyright notice, this
   list of conditions and the following disclaimer. 
2. Redistributions in binary form must reproduce the above copyright notice,
   this list of conditions and the following disclaimer in the documentation
   and/or other materials provided with the distribution. 

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

The views and conclusions contained in the software and documentation are those
of the authors and should not be interpreted as representing official policies, 
either expressed or implied, of the FreeBSD Project.
 
