<?php

$table = new pf_tables();
$table->startTable('bannedplayers', null, null, 'table tablestripped');
$table->startRow();
$table->addCell('Player');
$table->addCell('Banned Since');
$table->endRow();


foreach ($data as $info)
{
    
    $table->startRow();
    $table->addCell($info['player']);
    $table->addCell($info['since']);
    $table->endRow();
}

$table->renderTable();

?>
