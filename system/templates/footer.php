<?php
$this_year = date("Y");
if (pf_config::get('creation_date') === $this_year) $date = $this_year;
else $date = pf_config::get('creation_date') . " - " . $this_year;


?>
<div class="footer">
&copy; <?php echo $date; ?> - <?php echo pf_config::get('site_name'); ?> - Designed By: <a href="<?php echo pf_config::get('author_uri'); ?>"><?php echo pf_config::get('author_name'); ?></a>
</div>