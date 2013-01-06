<?php
//get current version
$remotedata = file_get_contents('http://www.craftycontroller.com/data.php?info=latest&type=json');
$result = json_decode($remotedata,true);

//split versions based on number and type
$stable = explode("-", $result['stable']);  //our remote stable
$dev = explode("-", $result['dev']);        //our remote dev
$current = explode("-",APP_VERSION);        //our current

//init our update variables
$update_stable = false;
$update_dev = false;



//check our stable
if ($current[0] < $stable[0]) $update_stable = true;
else 
{
    if (parsetype($current[1]) < parsetype($stable[1])) $update_stable = true; //check branches (alpha,beta,rc,stable)
}

if ($current[0] < $dev[0]) $update_dev = true;
else 
    {
    if (parsetype($current[1]) < parsetype($dev[1])) $update_dev = true;
    }

//inform of update
if ($update_stable) echo '<div id="newrelease" class="span12 warning center" style="padding:0;background-image:none;"><a href="'.$result['stable_link'].'"><b>Update:</b>New Stable Release Available</a></div>';
if ($update_dev) echo '<div id="latestrelease" class="span12 warning center" style="padding:0;background-image:none;"><a href="'.$result['dev_link'].'"><b>Update:</b>New Dev Release Available</a></div>';


function parsetype($type)
{
    $type=  strtolower($type);
    
    $level = 0;
    if ($type == 'alpha') $level = 0;
    elseif ($type == 'beta') $level = 1;
    elseif ($type == 'rc') $level = 2;
    elseif ($type == 'stable') $level = 3;
    else $level=0;
    return $level;
}


?>