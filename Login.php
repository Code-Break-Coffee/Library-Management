<?php
session_start();
include "dbconnect.php";
$user;$pass;
if(!empty($_POST["username"]) && !empty($_POST["password"]))
{
    $user=$_POST["username"];
    $pass=$_POST["password"];

    $_SESSION["username"]=$user;
    $_SESSION["password"]=$pass;

    $sql="SELECT * from admin;";
    $result=$conn->query($sql);
    $flag=0;
    if($result)
    {
        while($row=$result->fetch_assoc())
        {
            if($row["Username"] == $user && $row["Password"] == $pass)
            {
                $flag=1;
                include "Main.php";
            }
        }
    }
    if($flag==0)
    {
        echo "<script>window.alert('Incorrect Username or Password!!!');</script>";
        include "index.html";
    }
}
else
{
    echo "<script>window.alert('Unauthorized Access!!!');</script>";
    include "index.html";
}
?>