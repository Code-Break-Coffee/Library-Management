<?php
    $host="localhost:3306";
    $username="tanishq";
    $password="12345";
    $dbname="library";

    $conn=new mysqli($host,$username,$password,$dbname);

    if(!$conn)
    {
        die("Connection failed!!!".$conn->error);
    }
?>