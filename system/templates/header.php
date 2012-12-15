<?php
/*Meta Info*/
pf_html::addMetaTag('author', pf_config::get('author'));              //author info
pf_html::addMetaTag('keywords', pf_config::get('keywords'));          //keywords
pf_html::addMetaTag('description', pf_config::get('description'));    //desciption

/*Stylesheets*/

pf_html::addStylesheet('dropdown/dropdown.css');    //the main dropdown css
pf_html::addStylesheet('dropdown/themes/default.css');    //the dropdown styling css

pf_html::addStylesheet('frame.css');                //main framework stylesheet
pf_html::addStylesheet('style.css');                //main site stylesheet

/*Scripts*/
pf_html::addShortcutIcon(pf_config::get('shortcut_icon'));            //shortcut icon
pf_html::addScriptExternal('http://code.jquery.com/jquery-latest.min.js');//jquery
pf_html::addScriptExternal('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');//jquery UI
pf_html::addScriptInternal('showHideToggle.js');    //show/hide toggle pluggin

/*Title*/
pf_html::setTitle(pf_config::get('shotrcut_icon'));

/*Render the head information*/
pf_html::renderHead();
?>
