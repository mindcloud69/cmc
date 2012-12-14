<?php pf_core::loadTemplate('header'); ?>
 <script type="text/javascript">
        //for our debug info
        $(document).ready(function(){ 
            $('.show_hide').showHide({speed: 500,changeText: 1,showText: 'View',hideText: 'Close'});  
            $("#debug").hide(); 
        }); 
</script>
<div id="error" class="alert" style="text-align:center;"><b>FATAL ERROR</b>:<?php echo $data['error']?> </div>
<?php 
if (key_exists('debug', $data))
{
        echo $data['debug'];
}
?>
<?php pf_core::loadTemplate('footer'); ?>
