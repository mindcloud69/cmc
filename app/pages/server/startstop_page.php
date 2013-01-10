<div class="row">
    
    <div class="panel four columns">
        <p><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/lightning.png"/>Start your server based on the latest config. Please note the server will not start if already running.</p>
        <div class="twelve columns offset-by-two"><a id='startscript'class="six success button rounded" href="<?php echo pf_config::get('main_page') ?>/server/startup">Start Server</a></div><br /><br />
    </div>
    
    <div class="panel four columns">
        <p><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/blocked.png"/>Stops the server that is currently running. This will also disable the auto-restart crash detection script</p>
        <div class="twelve columns offset-by-two"><a class="six alert button rounded" href="<?php echo pf_config::get('main_page') ?>/server/stop">Stop Server</a></div>
    </div>
    
</div>
