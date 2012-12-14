<?php pf_core::loadTemplate('header');?>


 <script type="text/javascript">
        //for our debug info
        $(document).ready(function(){ 
            $('.show_hide').showHide({speed: 500,changeText: 1,showText: 'View',hideText: 'Close'});  
            $("#debug").hide(); 
        }); 
</script>

<div id="phils404">
<h1 class="center">404!</h1>
<h2 class="center">Oh Snap, You Broke The Internets</h2>
<p class="center">
    Not really, but the page your looking for doesn't actually exist.<br />
    Perhaps you should double check your link and make sure it's correct or <br/>
    <a href="<?php echo pf_config::get('base_url');?>"> Hit up the main site</a>
</p>
<p class="center">Powered by <?php echo APP_NAME . '-' . APP_VERSION; ?></p>
</div>
<?php pf_core::loadTemplate('footer');?>