<?php
/*
 * Copyright 2012 - Phillip Tarrant
 * License: http://creativecommons.org/licenses/by-sa/3.0/deed.en_US
 */
if (!defined('APP_NAME')) die('NO DIRECT SCRIPT ACCESS!');

class pf_forms {
    
    private static $form;       //our form
    
    public static function createForm ($id='form',$class=null,$action = null, $method=null,$tableclass=null)
    {
        if (!isset($method)) $method="POST";
        if (!isset($action)) $action = $_SERVER['REQUEST_URI'];
        if(isset($class)) $class= 'class= "'.$class.'"';
            
        $form = '<form id="'.$id.'" '. $class. ' action="'.$action.'" method="'.$method.'">'."\n";
        echo $form;
    }
    
    public static function text($name='textfield',$required=null,$value=null,$placeholder=null,$id=null)
    {
        $input = "";
        
        //input
        $input .= '<input type="text" name="'.$name.'" ';
        
        if (isset($required)) $input.= ' required';
        if (isset($value)) $input.= ' value="'.$value .'"';
        if (isset($placeholder)) $input .= ' placeholder="'.$placeholder.'"';
        if (isset($id)) $input .= ' id="'.$id.'"';
        
        $input .="/>";
        
        echo $input. "\n";
    }
    
    public static function hidden($name='hiddenfield',$value='hiddenvalue')
    {
        echo '<input type="hidden" name="'.$name.'" value="'.$value.'" />'."\n";
    }
    
    public static function password($placeholder=null)
    {
        echo '<input type="password" name="password" placeholder="'.$placeholder.'"/>'."\n";
    }
    
    public static function button($value='submit',$label=null,$class=null,$onclick=null)
    {
        if (strtolower($value) == strtolower('submit'))
        {
            $input = '<input type="submit" value="'.$label.'"';
        }
        else $input = '<input type="button" value="'.$label.'"';
        
        if (isset($name)) $input .= ' name="'.$name.'"';
        if (isset($class)) $input .= ' class="'.$class.'"';
        if (isset($onclick)) $input .= ' onclick="'.$onclick.'"';
        $input .="/>";
        echo $input . "\n";
    }
    
    public static function options($name,$label,$options=array(),$selected=null)
    {
        $html = '<select name="'.$name.'">'."\n";
        
        foreach ($options as $value=>$text)
        {
            if (strtolower($value) == strtolower($selected)) $html .= pf_html::indent ().'<option selected="selected" value="'.$value.'">'.$text.'</option>'."\n";
            else $html .= pf_html::indent ().'<option value="'.$value.'">'.$text.'</option>'."\n";
        }
        
        $html .= '</select>'."\n";
        echo $html;
    }
    public static function closeForm()
    {
        echo '</form>';
    }
    
}

?>
