<?php 
        //some general metatags
        pf_html::metaTag('author', 'Phillip Tarrant, Noah Rossi'); //our author metatag
        pf_html::metaTag('Generator', 'Phils Framework');

        //stylesheets
        pf_html::stylesheet('bootstrap.css');
        pf_html::stylesheet('bootstrap-responsive.css');
        pf_html::stylesheet('frame.css');
        pf_html::stylesheet('style.css');


        //jquery love
        pf_html::scriptExternal('http://code.jquery.com/jquery-latest.js');//perhaps we should use Googles CDN?
        pf_html::scriptInternal('showHideToggle.js');//framework show/hide jquery plugin
        pf_html::scriptInternal('bootstrap.js'); //bootstrap js
        ?>

        <title>Minecraft Server Control</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
