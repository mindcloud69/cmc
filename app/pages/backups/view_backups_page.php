<!DOCTYPE html>
<html>
	<head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <?php pf_core::loadTemplate('header'); ?>
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
            <div class="container">
                <div class="row">
                    
                    <?php
                    if (key_exists('error', $data)):?>
                    <div class="six columns centered"><div class='alert'><?php echo $data['error'];?></div></div>
                    <?php else:?>
                        
                    <h3 class="center">View Backups</h3>
                    <h4 class="center">Sorted By Date - Latest at top</h4>
                    <form id="backupdelete" class= "twelve centered columns " action="<?php echo pf_config::get('main_page');?>/backups/delete" method="POST">
                    <?php
                    if (!empty($data['backups']))
                    {
                        
                    //table of old backups
                    $table = new pf_tables();
                    $table->startTable('backups', 0, 100, 'table table-striped ');
                    $table->startRow();
                    $table->addTableHeading('<input type="checkbox" id="selectall"/>');
                    $table->addTableHeading('Backup Filename');
                    $table->addTableHeading('Date Created');
                    $table->addTableHeading('Filesize');
                    $table->addTableHeading('Download');
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
                        $table->addCell('<center>'.pf_core::formatBytes(filesize($backup)).'</center');
                        $table->addCell('<center><a class="button rounded success" href="'.MAIN_PAGE.'/backups/download?file='.$backup.'">Download</a></center');
                        $table->endRow();
                    }
                    $table->renderTable();
                    }
                    
                    ?>
                        <div class="twelve offset-by-two "><input type="submit" value="Remove Selected Backups" class=" alert eight columns button rounded center"></div>
                    </form>
                    <?php endif;?>
                    </div>
            </div>
    </body>
</html>
