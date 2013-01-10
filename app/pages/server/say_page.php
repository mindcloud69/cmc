<div class="span4 offset4">
    <h3 class="center">What Do You Wish To Say?</h3>

    <?php pf_forms::createForm('say', 'serversay', pf_config::get('main_page').'/server/say', 'GET'); ?>
    Server Says: <?php pf_forms::text('command', true, null, 'Enter What You Wish To Say');
    pf_forms::button('submit','Say It!','button rounded');
    ?>

</div>
