
<h1>Add a user</h1>
<?php
pf_forms::createForm('adduser',null,pf_config::get('main_page').'/users/add');
pf_forms::text('username', true, null, 'Username');
pf_forms::text('password', true, null, 'Password');
pf_forms::button('submit', 'Add User');
pf_forms::closeForm();
?>
