<?php
include "dbconnect.php";
if(empty($_POST["fac_name"]) || empty($_POST["fac_id"]) || empty(filter_input(INPUT_POST,"fac_type")))
{
    header("Location: /LibraryManagement/");
}
else
{
    $facName=$_POST["fac_name"];
    $facId=$_POST["fac_id"];
    $facType=filter_input(INPUT_POST,"fac_type");

    
}
?>