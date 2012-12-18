<h1>Start Server Script</h1>
<?php 
pf_forms::createForm('startserver', null, pf_config::get('main_page')."scripts/start", 'POST');

?>
<form id="startserver">
    <select name="startram">
        <options value="1024">1Gb Memory</option>
        <options value="2048">2Gb Memory</option>
        <options value="3072">3Gb Memory</option>
        <options value="4096">4Gb Memory</option>
        <options value="5120">5Gb Memory</option>
        <options value="6144">6Gb Memory</option>
        <options value="7168">7Gb Memory</option>
        <options value="8192">8Gb Memory</option>
    </select>
    <select name="maxram">
        <options value="1024">1Gb Memory</option>
        <options value="2048">2Gb Memory</option>
        <options value="3072">3Gb Memory</option>
        <options value="4096">4Gb Memory</option>
        <options value="5120">5Gb Memory</option>
        <options value="6144">6Gb Memory</option>
        <options value="7168">7Gb Memory</option>
        <options value="8192">8Gb Memory</option>
    </select>
    
</form>
