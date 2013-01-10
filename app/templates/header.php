<?php 
        //some general metatags
        pf_html::metaTag('author', 'Phillip Tarrant, Noah Rossi'); //our author metatag
        pf_html::metaTag('Generator', 'Phils Framework');

        //stylesheets
        //pf_html::stylesheet('bootstrap.css');
        //pf_html::stylesheet('bootstrap-responsive.css');
        pf_html::stylesheet('frame.css');
        pf_html::stylesheet('style.css');
        
        pf_html::stylesheet('foundation.min.css');
        


        //jquery love
        pf_html::scriptInternal('jquery.js');//Jquery Love
        pf_html::scriptInternal('showHideToggle.js');//framework show/hide jquery plugin
        pf_html::scriptInternal('foundation.min.js'); //Foundation js
        pf_html::scriptInternal('modernizr.foundation.js'); //Another Foundation js
        pf_html::scriptInternal('jquery.foundation.tabs.js'); //Another Foundation js
        pf_html::scriptInternal('jquery.foundation.navigation.js'); //Another Foundation js
        pf_html::scriptInternal('jquery.foundation.accordian.js'); //Another Foundation js
        ?>

        <title>CMC - Crafty Minecraft Controller</title>
        <meta name="viewport" content="width=device-width">
