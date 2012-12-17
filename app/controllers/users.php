<?php

class users extends pf_controller
{
    public function index()
    {
        
        $sqlite = "sqlite:".APPLICATION_DIR.'config'.DS.'CMC.db';
        $db = new db($sqlite);
        
        $table = new pf_tables();
        
        //create some pretty tables
        $table->startTable('users');
        $table->startRow();
        $table->addCell('ID');
        $table->addCell('Name');
        $table->addCell('Level');
        $table->endRow();
        
        
        //grab our users
        $results= $db->select('Users');
        foreach ($results as $user)
        {
            $table->startRow();
            $table->addCell($user['ID']);
            $table->addCell($user['User']);
            $table->addCell($user['Level']);
            $table->endRow();
        }
        
        $table->renderTable();
        
        //grab content
        $content = ob_get_contents();
        //erase content
        pf_html::clearPreviousBuffer();
        
        //put content into data array
        $data['users_table']=$content;
        
        //load the page and pass data
        $this->loadView('users/all_users_page.php',$data);
        
        
    }
    
}
?>
