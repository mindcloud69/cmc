<?php
pf_forms::createForm('say', null, pf_config::get('main_page').'/scripts/say', 'GET');
pf_forms::text('command', true, null, 'Enter What You Wish To Say');
pf_forms::button('submit','Say It!');
?>
