<?php
include "dbconnect.php";

session_start();
$doi = date("Y/m/d");
date_default_timezone_set("Asia/Kolkata");
$title;
$M_Name;
$M_Type;
$Available=false;
$b=$_POST["Book_No"];
$m=$_POST["Member_ID"];
$sql_b="SELECT * from books where Book_No = '$b'";
$sql_f="SELECT * from member_library where Member_ID = '$m'";
$result_b = $conn->query($sql_b);
$result_f = $conn->query($sql_f);

if($result_b && $result_f){
    while($row = $result_b->fetch_assoc()){
        $title = $row["Title"];
        if($row["Status"] =="available"){
            $Available = true;
        }
    }
    while($row = $result_f->fetch_assoc()){
        $M_Name = $row["Member_Name"];
        $M_Type = $row["Member_type"];
    }
    if($Available){
        $sql_ir="INSERT INTO issue_return (Book_No,Title,Member_ID,Member_Name,	Date_issue,	Date_return,Member_type)
        values ('$b','$title','$m','$M_Name','$doi','NA','$M_Type');";
        $resultIssue=$conn->query($sql_ir);
        if($resulIssue){
            $sql_Update = "UPDATE books set Status='$m' where Book_No = $b;";
            $update_book = $conn->query($sql_Update);
            echo"<script>window.alert('Data stored successfully');</script>";
        }
    }
}
else{
    echo"<script>window.alert('BSDK correct data enter kar');</script>";
    echo "$conn->error";
    echo"<script>window.history.back();</script>";
}



?>