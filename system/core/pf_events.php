<?php if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');
/* -----------------------------------------------------------------------------
 * PF_LOGS - Handles all logging / errors for our framework.
 * -----------------------------------------------------------------------------
 */

class pf_events {
    
    private static $log = array();
    
    //logs an event
    public static function eventsAdd($message,$caller=null,$line=null)
    {
        if (empty($caller)) //if no calling file was specified
        {
            $backtrace =  debug_backtrace(); //create a backtrace
            $file = $backtrace[0]['file'];
            $line = $backtrace[0]['line'];
            self::$log[]=array('Message'=>$message,'Caller'=>$file,'Line'=>$line, 'Time'=>date("g:i:s a"));
        }
        else self::$log[]=array('Message'=>$message,'Caller'=>$caller,'Line'=>$line, 'Time'=>date("h:i:s a"));
    }
    
    //displays the logged events for the app Very useful for debugging
    public static function eventsDisplay()
    {
        echo '<div class="center"><a href="#" class="show_hide" rel="#debug">Toggle Debug Window</a></div>'."\n";
        //since we are using a helper class, we REQUIRE it to be there to work.
        if (!class_exists('pf_tables')) die('Tables Class Not Found!');

        //create a tables object
        $table = new pf_tables;
        
        //open the table
        $table->startTable('debug',1,100,'center');
        
        //set the caption
        $table->setTableCaption('Debug Data');
        
        //create the headings
        $table->addTableHeading("File");
        $table->addTableHeading('Message');
        $table->addTableHeading('Line Numbers');
        
        //for each item in the log, we add a row to the table
        foreach (self::$log as $index=>$data)
        {
            $table->startRow('left');
            $table->addcell($data['Caller']);
            $table->addcell($data['Message']);
            $table->addcell($data['Line']);
            $table->endRow();
        }
        $table->renderTable();  //display the table
    }
    
    //displays a warning
    public static function displayWarning($message)
    {
        echo '<div id="error" class="warning" style="text-align:center;"><b>WARNING</b>: '.$message."</div>\n";
    }
    
    //displays a fatal warning then dies;
    public static function dispayFatal($message)
    {
        echo '<div id="error" class="alert" style="text-align:center;"><b>FATAL ERROR</b>: '.$message."</div>\n";
        self::eventsAdd('Throwing Fatal Message then dying');
        if (SHOW_DEBUG_MESSAGES) pf_events::eventsDisplay ();
        die();
    }
    
    
}

?>
