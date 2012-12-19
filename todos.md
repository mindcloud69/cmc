#Todo List

I suggest we use github for this, they have issue tracking and milestones.
I'm testing things out with it now. Seems better as we can just reference 
issue #'s in our commits etc. We can even have Milestones (versions).

If you like the system, let me know and I'll start assigning things to you
via github. might be easier than the flat file we are using.

## ptarrant
 * Start/Stop/Restart Server from page <-- next on list.
 * Script Scheduling
 * Op/Kick/Ban players
 * Split server.log into [info] and chat 1/2 done :/
 * color chat messages and remove the color format from log output
 * Manage Backup/Server_Check/Server_Restart Script Schedules
 * Manage Backups and Schedule them.
 * Eventually add Essentials config to this beast!


 
## Zippy
 * Read all the emails p.t. sent me :D
 * Config forms
 * Style the config page
 * Work on learning PHP
 * Ban/OP/Kick buttons
 * General interface improvement
 * Figure out a way to make the progress bar width match the processor core number
 * Possibly revamp CPU/RAM bars.
 

##Major Projects
Every page needs to have styling done in 1 css file (assets/css/style.css is good) it makes things cleaner.

###pages/main_page.php
the console now has the raw server log (only 75 lines)
I did some quick css to limit the height and overflow scroll
change as you see fit to make it pretty. Possibly revamp CPU/RAM bars.
  
###pages/users/add_users_page.php
Prettify it's a new page

###pages/users/all_users_page.php
Prettify it's a new page

###templates/error.php
Prettify it's a new page . 
also I had some old jquery in there...I have the plugin for the .showhide in JS if you want to use it.
it basically hides the debug data from my system. if the debug setting is set to false, it won't be generated anyway.
debug setting will be set to false on ANY releases!!! <-- we both gotta remember to set that.

###pages/server/config_page.php
Filled out the form including current settings, the placeholders/selected settings are most common
had to put everything in a table to make things appear more "in line".
prettify it.
