<?php
    include "dbconnect.php";
    
    $u=$_POST["user"];
    $p=$_POST["pass"];
    $sql="SELECT * from admin;";
    $result=$conn->query($sql);
    
    if($result)
    {
        while($row=$result->fetch_assoc())
        {  
            if($row["Username"]==$u && $row["Password"]==$p)
            {
                include "menu.php";
            }
            else
            {
                echo"<script>window.alert('Enter correct credentials');</script>";
                echo"<script>window.history.back();</script>";
            }
        }
    }
    
?>