<?php if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');

/* -----------------------------------------------------------------------------
 * PF_HTML - Helper class for common HTML stuff
 * -----------------------------------------------------------------------------
 */
class pf_html
{
    private static $headobjects = array();      //array full of header info
        
    public static function indent($times=null)
    {
        if (empty($times)) $times=1;
        
        $indent = "";
        for ($i=1; $i<=$times; $i++)
        {
            $indent .= "    ";
        }
        return $indent;
    }
    
    public static function addMetaTag($type,$data)
    {
        self::$headobjects[]='<meta name="'.$type.'" content="'.$data.'"/>';
    }
    public static function renderHead()
    {
        $html = "<!DOCTYPE html> \n<html>\n".pf_html::indent()."<head>\n";
        $html .= pf_html::indent(2).'<meta name="generator" content="'.APP_NAME ." - ". APP_VERSION .'" />'."\n";
        
        foreach (self::$headobjects as $line)
        {
           $html.= pf_html::indent(2)."$line \n";
        }
        
        $html .= pf_html::indent()."</head>\n";
        echo $html;
    }
    public static function addStylesheet($stylesheet)
    {
        if (substr($stylesheet, 0,4)=="http")
        {
        self::$headobjects[]='<link rel="stylesheet" media="all" type="text/css" href="'.$stylesheet.'" />';
        }
        else
        {
            self::$headobjects[]='<link rel="stylesheet" media="all" type="text/css" href="'.pf_config::get('base_url').pf_config::get('stylesheet_dir').$stylesheet.'" />';
        }
    }
    public static function setTitle($title)
    {
        self::$headobjects['title']="<title>$title</title>";
    }
    public static function addShortcutIcon($file)
    {
        self::$headobjects[]='<link rel="shortcut icon" href="'.pf_config::get('base_url').pf_config::get('stylesheet_dir').'images/'.$file.'" type="image/gif" />';
    }
    public static function addScriptExternal($url)
    {
        self::$headobjects[]='<script src="'.$url.'"></script>';
    }
    public static function addScriptInternal($file)
    {
        self::$headobjects[]='<script src="'.pf_config::get('base_url').pf_config::get('java_dir').$file.'"></script>';
    }
    
    public static function clearPreviousBuffer()
    {
        ob_clean();
    }
    public static function endPage()
    {
        echo "\n</html>\n";
        ob_flush();
        
    }
    public static function addImage($file,$alt=null,$title=null,$class=null)
    {
        $link = pf_router::$basepath.'/'.APPLICATION_DIR.'/'.SITE_IMAGES_FOLDER.'/'.$file;
        if (!file_exists(APPLICATION_DIR.DS.SITE_IMAGES_FOLDER.DS.$file))
        {
            pf_events::eventsAdd ('Unable to find: '.$file . ' in ' . APPLICATION_DIR. DS . SITE_IMAGES_FOLDER);
            $link = '';
        }
        echo '<img src="'.$link.'" ';
        if ($alt) echo 'alt="'.$alt.'" ';
        if ($title) echo 'title="'.$title.'" ';
        if ($class) echo 'class="'.$class.'" ';
        echo '/>';
        
    }
    
}

?>
