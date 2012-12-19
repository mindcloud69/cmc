<h1>Start Server Script</h1>

<form id="startserver" action="<?php echo pf_config::get('main_page');?>/scripts/startup" method="POST">
    Amount Of Ram To Reserve At Startup:
    <select name="startram">
        <option value="1024">1Gb Memory</option>
        <option value="2048">2Gb Memory</option>
        <option value="3072">3Gb Memory</option>
        <option value="4096">4Gb Memory</option>
        <option value="5120">5Gb Memory</option>
        <option value="6144">6Gb Memory</option>
        <option value="7168">7Gb Memory</option>
        <option value="8192">8Gb Memory</option>
    </select>
    Previously <?php echo ($data['Startram']/1024); ?>GB
    <br />
    Max Amount Of Ram To Use:
    <select name="maxram">
        <option value="1024">1Gb Memory</option>
        <option value="2048">2Gb Memory</option>
        <option value="3072">3Gb Memory</option>
        <option value="4096">4Gb Memory</option>
        <option value="5120">5Gb Memory</option>
        <option value="6144">6Gb Memory</option>
        <option value="7168">7Gb Memory</option>
        <option value="8192">8Gb Memory</option>
    </select>
    Previously <?php echo ($data['Maxram']/1024); ?>GB
    <br />
    <input type="submit" value="Save and Start Server"/>
</form>
