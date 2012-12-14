<?php if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');

/* -----------------------------------------------------------------------------
 * PF_MENU - Builds Pretty Listed Menus For Us.
 * -----------------------------------------------------------------------------
 */ 
class pf_menu {
    
    private static $menu = array();     //our menu
    private static $submenu = array();  //our submenus
    private static $active;             //for manual override of active tab
    
    public static function addTopLevel($title,$url,$internal=true,$has_children=NULL)
    {
        pf_events::eventsadd("Adding Menu Item: $title");
        //if an internal link, we add our base URL to it.
        if ($internal) $url = pf_config::get('base_url').pf_config::get ('index_page')."/".$url;
        self::$menu[] = array ('title'=>$title,'url'=>$url,'children'=>$has_children);
    }
    
    public static function addSubmenu($parent,$title,$url)
    {
        pf_events::eventsadd("Adding Submenu Item: $title - With The Parent of: $parent");
        self::$submenu[]=array('parent'=>$parent,'title'=>$title,'url'=>$url);
    }
    
    public static function setActive($title)
    {
        pf_events::eventsadd("Setting Active Link to: $title");
        self::$active=$title;
    }
    
    public static function renderMenu($class=null)
    {
        pf_events::eventsadd('Looking for BASE_URL in pf_config::$app');
        if (!pf_config::get('base_url'))
        {
            pf_events::eventsadd('Base Url Not Set in pf_config: using relative paths');
            pf_events::displayWarning("Menu System Can't Find BASE_URL!");
        }
        
        $menu = '';
        $classes = '';
        
        //creates the <UL>
        //using the class if it's set, if not we ignore it.
        if (isset($class)) $menu='<ul id="nav" class="'.$class.'">'."\n";
        else $menu='<ul id="nav">'."\n";
        
        //for each menu item, we make a list item <LI>
        foreach (self::$menu as $item => $menuitems)
        {
            $menu .= pf_html::indent(2)."<li";
            
            //Checking for any classes to apply ----------
            //does it have children?
            if ($menuitems['children']) $has_children=true;
            
            //is the top menu item active?
            if (strtolower($menuitems['title']) == strtolower(self::$active)) $classes=" active ";
            
            //does it have kids?
            if ($menuitems['children']) $classes .= " submenu";
            
            //if we have classes, we apply them
            if (!$classes == '') $menu .= ' class = "' . $classes . '"';
            
            //Complete LI Tag ( the ending > )
            $menu .= '>';

            //make the link inside the LI TAG
            $menu .= '<a href="' . $menuitems['url'] . '">'.$menuitems['title']."</a>";        
            
            //if it has children
            if ($menuitems['children'])
            {
                
                $menu .= "\n".pf_html::indent(3).'<ul>'."\n";
                foreach (self::$submenu as $item => $submenus)
                {
                   if (strtolower($submenus['parent']) == strtolower($menuitems['title']))
                   {
                       $menu .= pf_html::indent(4).'<li class="dir"><a href="'. $submenus['url'] . '">'.$submenus['title']."</a></li>\n";
                   }
                }
                $menu .= pf_html::indent(3)."</ul>\n";
            }
            
            //close the LI TAG </LI>
            $menu .= "</li>\n";
        }
        
        $menu .=  pf_html::indent()."</ul>\n";
        echo $menu;
    }
    
}

?>
