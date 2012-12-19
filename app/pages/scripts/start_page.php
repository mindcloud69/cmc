<h1>Start Server Script</h1>



<form id="startserver" action="<?php echo pf_config::get('main_page');?>/scripts/start" method="POST">
    Amount Of Ram To Reserve At Startup:
    <select name="Startram">
        <option name="1024">1Gb Memory</option>
        <option name="2048">2Gb Memory</option>
        <option name="3072">3Gb Memory</option>
        <option name="4096">4Gb Memory</option>
        <option name="5120">5Gb Memory</option>
        <option name="6144">6Gb Memory</option>
        <option name="7168">7Gb Memory</option>
        <option name="8192">8Gb Memory</option>
    </select>
    Previously <?php echo ($data['Startram']/1024); ?>Gb
    <br />
    Max Amount Of Ram To Use:
    <select name="Maxram">
        <option name="1024">1Gb Memory</option>
        <option name="2048">2Gb Memory</option>
        <option name="3072">3Gb Memory</option>
        <option name="4096">4Gb Memory</option>
        <option name="5120">5Gb Memory</option>
        <option name="6144">6Gb Memory</option>
        <option name="7168">7Gb Memory</option>
        <option name="8192">8Gb Memory</option>
    </select>
    Previously <?php echo ($data['Maxram']/1024); ?>Gb
    <br />
    <input type="submit" value="Save and Start"/>
</form>
