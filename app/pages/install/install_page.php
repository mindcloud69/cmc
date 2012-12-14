<h1>
    WOOT FINALLY THE INSTALLER!!!
</h1>


Zippy,
<br />
We need a pretty form here.
<br />
One that will get the following Info:<br />
Admin User<br />
Admin Password<br />
Bukkit Installed Dir<br />
<br />
Here is a template:<br />
<br />
Notice I'm using a PHP class here. I wrote this helper class to make forms easier.<br />
I also wrote one for tables, let me know if you want to learn how to use it.<br />
<br />

<?php pf_forms::createForm('installer',null,'/install/go'); ?><br />
Admin Username: <?php pf_forms::text('username');?><br />
Admin Password: <?php pf_forms::password();?><br />
<br />
Bukkit Install Dir: <?php pf_forms::text('bukkit', true,null,'/bukkit');?><br />
<?php pf_forms::button('submit','Install');?>

<?php pf_forms::options('options', 'options', array('true'=>'true','false'=>'false')); ?>
<?php pf_forms::closeForm(); ?>

