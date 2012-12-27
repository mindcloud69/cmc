<?php 
/*
 * Copyright 2012 - Phillip Tarrant
 * License: http://creativecommons.org/licenses/by-sa/3.0/deed.en_US
 */
if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');

/* -----------------------------------------------------------------------------
 * PF_TABLES - Builds tables for our app
 * -----------------------------------------------------------------------------
 */

class pf_tables {
    
    private $caption = null;            //table caption
    private $temprow = '';              //our temp string while building a row
    private $tableopen;                 //our tables opening statement
    private $tableheadings = array();   //our headers
    private $rows = array();            //our rows
    private $rowcount = 0;               //a count of rows
    
    
    //starts a table
    public function startTable($id,$border=0,$width=null,$class=null)
    {
        $tablehtml = '<table id="'.$id.'"';
        $tablehtml .= ' border="'.$border.'"';
        if (!empty($width))$tablehtml .= ' width="' . $width .'%"';
        if (!empty($class)) $tablehtml .= ' class="'.$class.'"';
        $tablehtml .=' cellspacing="0" cellpadding="0">';
        $this->tableopen=$tablehtml;
    }

    //starts a row
    public function startRow($align="")
    {
        $this->rowcount++;
        if ($odd = $this->rowcount%2) $evenodd='odd';
        else $evenodd='even';
        
        if (!empty($align)) $this->temprow= "\t\t<tr class='$evenodd' align='$align'>\n";
        else $this->temprow="\t\t<tr class='$evenodd'>\n";
    }
    
    //ends the row
    public function endRow()
    {
        $this->rows[]=$this->temprow."\t\t</tr>\n";
    }
    
    //adds a cell
    public function addCell($content,$span=0)
    {
        if ($span > 0) $cell= "\t\t\t<td colspan='$span'>";
        else $cell= "\t\t\t<td>";
        $cell .=$content."</td>\n";
        $this->temprow.=$cell;
    }
    
    //adds a table heading
    public function addHeading($content,$span=0)
    {
        if ($span > 0) $cell= "\t\t\t<td colspan='$span'>";
        else $cell= "\t\t\t<th>";
        $cell .=$content."</th>\n";
        $this->temprow.=$cell;
    }
    
    //sets the tables caption
    public function setTableCaption($caption)
    {
        $this->caption="<caption>$caption</caption>";
    }
    
    //sets the table heading
    public function addTableHeading($title)
    {
        $this->tableheadings[]=$title;
    }
    
    //displays our table
    public function renderTable()
    {
        echo $this->tableopen."\n";
        
        //if we have a caption
        if (!empty($this->caption)) 
            echo "\t".$this->caption."\n";
        
        //if we have headings in our array
        if (count($this->tableheadings)>0)
        {
            echo "\t"."<thead>"."\n";
            echo "\t\t"."<tr>"."\n";
            foreach ($this->tableheadings as $heading)
            {
                echo "\t\t\t"."<th>$heading</th>\n";
            }
            echo "\t\t</tr>\n";
            echo "\t"."</thead>"."\n";
        }
        
        //add each row to the table body
        echo "\t<tbody>\n";
        foreach($this->rows as $array)
        {
            echo $array;
        }
        echo "\t</tbody>\n";
        
        echo "</table>";
        
    }
}

?>
