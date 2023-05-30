<?php
include "dbconnect.php";
$user;$pass;
if(!empty($_POST["username"]) && !empty($_POST["password"]))
{
    $user=$_POST["username"];
    $pass=$_POST["password"];

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
                include "Main.html";
            }
        }
    }
    if($flag==0)
    {
        echo "<script>window.alert('Incorrect Username or Password!!!');</script>";
        include "index.html";
    }
}
?>