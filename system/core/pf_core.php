<?php
/*
 * Copyright 2012 - Phillip Tarrant
 * License: http://creativecommons.org/licenses/by-sa/3.0/deed.en_US
 */
if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');

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
    public static function loadTemplate ($file,$data=array())
    {
        //try to load the template from the app folder
        if (!self::loadFile($file, APPLICATION_DIR.'templates',$data))
        {
                //if that didn't work we try the main system template
            if (!self::loadFile($file, SYSTEM_DIR.'templates',$data))
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
 * Redirects our page via headerlocation (it's faster, and more secure)
 * ===========================================================================*/
    public static function redirectUrl($url,$time=0)
    {
        //$time = $time * 1000;
        $addbaseurl = true;
        
        //if it starts with http we assume its a fully complete URL
        if (self::compareStrings(substr($url,0,4), 'http')) $addbaseurl = false;
        
        //if it starts with www we assume we need to add "http://" before it;
        if (self::compareStrings(substr($url,0,3), 'www')) 
        {
        $addbaseurl = false;
        $url = 'http://'.$url;    
        }
        
                
        if ($addbaseurl) $url = pf_config::get('base_url') .pf_config::get ('index_page'). '/' . $url;
        
        header('Location: '.$url);
       
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
    
/* =============================================================================
 * Compares 2 versions
 * ===========================================================================*/
    public static function compare_versions($a,$b)
    {   
    //break the numbers down
    $a = explode('.',  rtrim($a, '.0')); //split versions into pieces and remove .0
    $b = explode('.',  rtrim($b, '.0')); //split versions into pieces and remove .0
    
    //iterate over each part of a
    foreach ($a as $depth => $aVal)
    {
        //if B matches A to this depth, comare the values
        if (isset($b[$depth]))
        {
            if ($aVal > $b[$depth]) return 1; //Return A > B | A is Greater than B
            else if ($aVal < $b[$depth]) return -1; //Return A < B | A is Less than B
        }
        //if B doesn't match A at this depth, then A comes after B in sort order
        else
        {
            return 1; //Return A > B | A is Greater than B
        }
    }
    //At this point, we know that to the depth that A and B extend to, they are equivalent. 
    //Either the loop ended because A is shorter than B, or both are equal. 
    return (count($a) < count($b)) ? -1 : 0; 
    }
    
    //makes a random code
    public static function randomCode($length)
    {
        $code = '';
        $possible = "2346789bcdfghjkmnpqrtvwxyzABCDFGHJKLMNPQRTVWXYZ";  //possible chars
        $maxlength = strlen($possible);
        $i=0;
        while ($i < $length)
        {
            $char = substr($possible, mt_rand(0, $maxlength-1), 1);
            if (!strstr($code,$char)) //have we already used this char?
            {
                    $code .=$char;
                    $i++;
            }
        }
        return $code;
    }
}//end of class

?>
