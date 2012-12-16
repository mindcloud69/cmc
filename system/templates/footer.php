<?php
$this_year = date("Y");
if (pf_config::get('creation_date') === $this_year) $date = $this_year;
else $date = pf_config::get('creation_date') . " - " . $this_year;


?>
<div class="footer">
&copy; <?php echo $date; ?> - <?php echo pf_config::get('site_name'); ?> - Designed By: <a href="<?php echo pf_config::get('author_uri'); ?>"><?php echo pf_config::get('author_name'); ?></a>&nbsp;<a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_US"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Crafty Minecraft Control</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="https://github.com/ptarrant/cmc" property="cc:attributionName" rel="cc:attributionURL">Phillip Tarant</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_US">Creative Commons Attribution-ShareAlike 3.0 Unported License</a>.
</div>