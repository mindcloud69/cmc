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
        pf_html::scriptExternal('http://code.jquery.com/jquery-1.8.3.min.js');
        pf_html::scriptInternal('showHideToggle.js');//framework show/hide jquery plugin
        ?>

        <title>CMC - Crafty Minecraft Controller</title>
        <meta name="viewport" content="width=device-width">
