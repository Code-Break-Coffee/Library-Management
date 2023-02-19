<?php
    $host="localhost";
    $username="Kartikey";
    $password="12345 hgy";
    $dbname="library";

    $conn=new mysqli($host,$username,$password,$dbname);

    if(!$conn)
    {
        die("Connection failed!!!".$conn->error);
    }
?>