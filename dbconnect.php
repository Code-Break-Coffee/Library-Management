<?php
    $host="localhost";
    $username="root";
    $password="";
    $dbname="library";

    $conn=new mysqli($host,$username,$password,$dbname);

    if(!$conn)
    {
        die("Connection failed!!!".$conn->error);
    }
?>