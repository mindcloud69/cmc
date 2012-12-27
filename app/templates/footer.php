<?php
$this_year = date("Y");
if (pf_config::get('creation_date') === $this_year) $date = $this_year;
else $date = pf_config::get('creation_date') . " - " . $this_year;


?>
<center><div class="footer">
&copy; <?php echo $date; ?> - <?php echo APP_NAME . " v" . APP_VERSION; ?><br />
<span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Created By:</span><a xmlns:cc="http://creativecommons.org/ns#" href="https://github.com/ptarrant/cmc" property="cc:attributionName" rel="cc:attributionURL">Phillip Tarant</a> | 
OS License: <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_US">BY-SA 3.0</a> | 
Donate via: <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=H2HNTLFZAJRXG&lc=US&item_name=Phillip%20Tarrant&item_number=CMC&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted">Paypal</a>
</div></center>