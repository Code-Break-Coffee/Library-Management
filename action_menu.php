<?php
    include "action_menu.html";
    include "dbconnect.php";

    session_start();

    $u=$_POST["user"];
    $p=$_POST["pass"];
    $sql="SELECT * from admin;";
    $result=$conn->query($sql);
    

    if($result){
        while($row=$result->fetch_assoc()){  
            if($row["Username"]==$u && $row["Password"]==$p)
            {
                echo"<script>window.alert('Welcome to admin page');</script>";
            }
            else{
                echo"<script>window.alert('Enter correct credentials');</script>";
                echo"<script>window.history.back();</script>";
            }
        }
    }
    
?>