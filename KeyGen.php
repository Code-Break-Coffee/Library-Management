<?php
function Gen()
{
    date_default_timezone_set("Asia/Kolkata");
    $dol = date("ymNdis");
    $log = date(DATE_RFC2822);
    $u = $_SESSION["username"];
    $hash = password_hash($u.$log.$dol, PASSWORD_BCRYPT);
    include "dbconnect.php";
    $sql_key_update = "UPDATE `temp_keys` SET `Key_Session` = '$hash', `Log` = '$log',`Log2` = '$dol' WHERE `Username` = '$u' ;";
    $update_key = $conn->query($sql_key_update);
    $_SESSION["Log"]=$log;
}