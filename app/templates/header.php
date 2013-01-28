<?php 
        //some general metatags
        pf_html::metaTag('author', 'Phillip Tarrant, 1001Zippy'); //our author metatag
        pf_html::metaTag('Generator', 'Phils Framework');

        //stylesheets
        pf_html::stylesheet('frame.css');
        pf_html::stylesheet('style.css');
        pf_html::stylesheet('foundation.min.css');
        
        //jquery love
        pf_html::scriptInternal('jquery.min.js');
        pf_html::scriptInternal('showHideToggle.js');//framework show/hide jquery plugin
        ?>

        <title>CMC - Crafty Minecraft Controller</title>
        <meta name="viewport" content="width=device-width">
