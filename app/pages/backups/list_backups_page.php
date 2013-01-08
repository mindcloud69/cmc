<!DOCTYPE html>
<html>
	<head>
            <?php pf_core::loadTemplate('header'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
            <SCRIPT language="javascript">
                $(function(){

                    // add multiple select / deselect functionality
                    $("#selectall").click(function () {
                          $('.delete').attr('checked', this.checked);
                    });

                    // if all checkbox are selected, check the selectall checkbox
                    // and viceversa
                    $(".case").click(function(){

                        if($(".delete").length == $(".delete:checked").length) {
                            $("#selectall").attr("checked", "checked");
                        } else {
                            $("#selectall").removeAttr("checked");
                        }

                    });
                });
                </SCRIPT>
            
	</head>
        <body>
        <?php pf_core::loadTemplate('menu'); ?>
            <h3 class="center">Backup Management</h3>
                        
            <div class="container">
                <div class="row">
                    
                    <?php
                    if (key_exists('error', $data)):?>
                        <div class='alert span6 offset3'><?php echo $data['error'];?></div>
                    <?php else:?>
                        
                    <form id="backupdelete" class= "span8 offset2" action="<?php echo pf_config::get('main_page');?>/backups/delete" method="POST">
                    <?php
                    if (!empty($data['backups']))
                    {
                        
                    //table of old backups
                    $table = new pf_tables();
                    $table->startTable('backups', 0, 100, 'table table-striped ');
                    $table->startRow();
                    $table->addTableHeading('<input type="checkbox" id="selectall"/>');
                    $table->addTableHeading('Previous Backups');
                    $table->addTableHeading('Date Created');
                    $table->endRow();
                    $i = 0;
                    foreach ($data['backups'] as $backup)
                    {
                        $i++;
                        
                        //time backup was created/modified
                        $createdate = date("m/d/Y H:i:s", filemtime($backup));
                        
                        $table->startRow();
                        $table->addcell('<input type="checkbox" class="delete" style="margin-left:8px;" name="file['.$i.']" value="'.$backup.'"/>');
                        $table->addCell($backup);
                        $table->addCell('<center>'.$createdate.'</center');
                        $table->endRow();
                    }
                    $table->renderTable();
                    }
                    
                    ?>
                    <input type="submit" value="Remove Selected Backups" class="button rounded center span8">
                    </form>
                    <?php endif;?>
                    </div>
            </div>
            <?php pf_core::loadTemplate('footer'); ?>
    </body>
</html>
