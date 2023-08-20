<?php
include "dbconnect.php";
$u=$_SESSION["username"];
// $p=$_SESSION["password"];
$result=$conn->query("SELECT * from admin where Username = '$u';");
$flag=0;
if($result)
{
    while($row=$result->fetch_assoc())
    {
        if($row["Username"] == $u)
        {
            $flag=1;
            include "Main2.php";
        }
    }
}
if($flag==0)
{
    echo "<script>window.alert('Unauthorized Access!!!');</script>";
    include "index.php";
}
session_destroy();
?>
