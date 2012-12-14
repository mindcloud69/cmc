<?php if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');

class pf_core {
    
/* =============================================================================
 * Loads a file from the dir specified
 * ===========================================================================*/
    private static function loadFile($file,$dir,$data=array())
    {
        //make sure the config file is carried along anytime a file is loaded
        $file = self::makePHPExtention($file);
        if (file_exists($dir. DS. $file))
        {
            require ($dir.DS.$file);
            return true;
        }
        return false;
    }
    
/* =============================================================================
 * Loads a Template from the system dir
 * ===========================================================================*/
    public static function loadTemplate ($file)
    {
        //try to load the template from the app folder
        if (!self::loadFile($file, APPLICATION_DIR.'templates'))
        {
                //if that didn't work we try the main system template
            if (!self::loadFile($file, SYSTEM_DIR.'templates'))
            {
                //if that fails, we say unable to load template and return false
                pf_events::eventsAdd ('Unable to load System Template: '.$file);
                pf_events::displayWarning('Unable to load Template: '.$file);
                return false;
            }
            else //if it loaded from the system template dir
            {
            pf_events::eventsAdd('Loaded Template: '.$file . ' from System Templates');
            return true;
            }
        }
        pf_events::eventsAdd('Loaded Template: '.$file . ' from the Application Templates');
        return true;
    }

/* =============================================================================
 * Makes sure the file ends in .php
 * ===========================================================================*/
    public static function makePHPExtention($file)
    {
        //grab the ext
        $ext = substr(strrchr($file, '.'), 1);
        //if it doesn't have php in it, we add it to the end of the file
        if (!($ext === "php"))
        {
        $file .=".php";
        }
        //return the corrected filename.
        return $file;
    }
    
    
/* =============================================================================
 * Redirects our page via javascript (it's the most reliable and flexible system
 * ===========================================================================*/
    public static function redirectUrl($url,$time=0)
    {
        $time = $time * 1000;
        $addbaseurl = true;
        
        //if it starts with http we assume its a fully complete URL
        if (self::compareStrings(substr($url,0,4), 'http')) $addbaseurl = false;
        
        //if it starts with www we assume we need to add "http://" before it;
        if (self::compareStrings(substr($url,0,3), 'www')) 
        {
        $addbaseurl = false;
        $url = 'http://'.$url;    
        }
        
        //if nothing modified addbaseurl, then we add the base url :)
        //if (substr(pf_config::$BASE_URL,1)=="/")
                
        if ($addbaseurl) $url = pf_config::get('base_url') .pf_config::get ('index_page'). '/' . $url;
        
        echo '<script type="text/javascript">' . "\n";
        echo 'setTimeout("location.href = '. "'$url';".'",'.$time.");";
        echo '</script>'. "\n";
    }

/* =============================================================================
 * Compares Strings
 * ===========================================================================*/
    public static function compareStrings($s1,$s2)
    {
        $s1 = strtolower($s1);
        $s2 = strtolower($s2);
        if ($s1 == $s2) return true;
        return false;
    }

/* =============================================================================
 * Converts data to string
 * ===========================================================================*/
    public static function toString($data)
    {
        return (string)$data;
    }
/* =============================================================================
 * Converts data to boolean
 * ===========================================================================*/
    public static function toBool($data)
    {
        return (boolean)$data;
    }    
    
}//end of class

?>
