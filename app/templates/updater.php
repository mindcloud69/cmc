<?php
//get current version
$remotedata = file_get_contents('http://www.craftycontroller.com/data.php?info=latest&type=json');
$result = json_decode($remotedata,true);

//split versions based on number and type
$stable = explode("-", $result['stable']);  //our remote stable
$dev = explode("-", $result['dev']);        //our remote dev
$current = explode("-",APP_VERSION);        //our current

//break it down to a funky beat---um I mean just make it easier to read
$current_version = $current[0];
$current_branch = $current[1];

$stable_version = $stable[0];
$stable_branch = $stable[1];

$dev_version = $dev[0];
$dev_branch = $dev[1];

//init our update variables
$update_stable = false;
$update_dev = false;

//compare versions
$stable_number = pf_core::compare_versions($current_version, $stable_version);
$dev_number = pf_core::compare_versions($current_version, $dev_version);

//compare current to stable - if current less than stable
if ($stable_number < 0 ) //if current less than stable
{
    $update_stable = true;
}
elseif ( $stable_number == 0 ) //if equal versions
{
    
    //we check to see if the current sub-branch is more than stable sub-branch
    if (parsetype($current[1]) < parsetype($stable[1]))
    {
    $update_stable = true; //check branches (alpha,beta,rc,stable)
    }
}

//compare current to dev - if current less than dev
if ($dev_number < 0 ) //if current less than dev
{
    $update_dev = true;
}
elseif ($dev_number == 0 ) //if equal versions
{
    //we check to see if the current sub-branch is more than stable sub-branch
    if (parsetype($current[1]) < parsetype($dev[1]))
    {
    $update_dev = true; //check branches (alpha,beta,rc,stable)
    }
}

//inform of update
if ($update_stable) echo '<div id="newrelease" class="span12 warning center" style="padding:0;background-image:none;"><a href="'.$result['stable_link'].'">New Stable Release Available:<b> '.$result['stable'].'</b></a></div>';
if ($update_dev) echo '<div id="latestrelease" class="span12 warning center" style="padding:0;background-image:none;"><a href="'.$result['dev_link'].'">New Dev Release Available:<b> '.$result['dev'].'</b></a></div>';


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