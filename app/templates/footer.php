<?php
$this_year = date("Y");
if (pf_config::get('creation_date') === $this_year) $date = $this_year;
else $date = pf_config::get('creation_date') . " - " . $this_year;


?>



<!-- Footer -->

  <footer class="row">
    <div class="twelve columns">
      <hr />
      <div class="row">
        <div class="four columns">
            <p>&copy; <?php echo $date; ?> <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title"></span><a xmlns:cc="http://creativecommons.org/ns#" href="https://github.com/ptarrant/cmc" property="cc:attributionName" rel="cc:attributionURL">Phillip Tarrant</a></p>
        </div>
		
        <div class="four columns">
            <p class='center'>
                Crafty Minecraft Controller<br />
                Version: <?php echo APP_VERSION; ?>
            </p>
        </div>
		
        <div class="four columns right">
            <ul class="link-list right">
                <li><a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_US"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/copy.png"/>&nbsp;License</a></li>
                <li><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=H2HNTLFZAJRXG&lc=US&item_name=Phillip%20Tarrant&item_number=CMC&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/paypal.png"/>&nbsp;Donate</a></li>
                <li><a href="https://twitter.com/craftycontrol"><img src="<?php echo pf_config::get('base_url');?>/app/assets/site_images/used/twitter.png"/>&nbsp;Follow</a></li>
            </ul>
        </div>
		
      </div>
      <div class="row">
        <?php 
        //call our updater function
        pf_core::loadTemplate('updater');
        ?>
        </div>
    </div>
  </footer>
