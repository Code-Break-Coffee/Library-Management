<?php
function Gen($u, $p)
{
    date_default_timezone_set("Asia/Kolkata");
    $dol = date("ymNdis");
    $log = date(DATE_RFC2822);
    $hash = password_hash($u.$log.$p.$dol, PASSWORD_BCRYPT);
    if($hash == false)
    {
        echo "<script>window.alert('Failed to login Try Again!!!');</script>";
        include "index.php";
        return false;
    }
    include "dbconnect.php";
    $sql_key_update = "UPDATE `temp_keys` SET `Key_Session` = '$hash', `Log` = '$log' WHERE `Username` = '$u' ;";
    $update_key = $conn->query($sql_key_update);
    $_SESSION["Log"]=$log;
    if ($update_key)
    {
        return true;
    }
    else
    {
        echo "<script>window.alert('Failed to login Try Again!!!');</script>";
        include "index.php";
        return false;
    } 
    
}