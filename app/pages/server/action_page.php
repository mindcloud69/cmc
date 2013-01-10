
<div class="row">
    <h4 class="center">Issue Server Command</h4>
    
    <div class="four columns offset-by-four">
    <?php pf_forms::createForm('action', '', pf_config::get('main_page').'/server/action', 'GET'); ?>
    Command Type: 
        <?php pf_forms::options('action', 'action',array(
            'ban'=>'Ban',
            'pardon'=>'Unban',
            'ban-ip'=>'Ban-ip',
            'pardon-ip'=>'Pardon-ip',
            'kick'=>'Kick',
            'op'=>'Op',
            'deop'=>'Deop',
            'custom' => 'Custom'
            )); ?><br />
    Command Object: <?php pf_forms::text('command', true, null, 'Object Of Command I.E. Username');?>
    <?php pf_forms::button('submit','Do It!','button rounded span4');
    ?>
</div>
           