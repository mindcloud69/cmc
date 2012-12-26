<?php
/*
 * Copyright 2012 - Phillip Tarrant
 * License: http://creativecommons.org/licenses/by-sa/3.0/deed.en_US
 */
if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');

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
    
    public static function metaTag($type,$data)
    {
        echo '<meta name="'.$type.'" content="'.$data.'"/>'."\n";
    }
    
    public static function stylesheet($stylesheet)
    {
        if (substr($stylesheet, 0,4)=="http")
        {
        echo '<link rel="stylesheet" media="all" type="text/css" href="'.$stylesheet.'" />'."\n";
        }
        else
        {
            echo '<link rel="stylesheet" media="all" type="text/css" href="'.pf_config::get('base_url').pf_config::get('stylesheet_dir').$stylesheet.'" />'."\n";
        }
    }
    
    public static function shortcutIcon($file)
    {
        echo '<link rel="shortcut icon" href="'.pf_config::get('base_url').pf_config::get('stylesheet_dir').'images/'.$file.'" type="image/gif" />'."\n";
    }
    
    public static function scriptExternal($url)
    {
        echo '<script src="'.$url.'"></script>'."\n";
    }
    
    public static function scriptInternal($file)
    {
        echo '<script src="'.pf_config::get('base_url').pf_config::get('java_dir').$file.'"></script>'."\n";
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
