<?php
include "dbconnect.php";

$doi = date("Y/m/d");
date_default_timezone_set("Asia/Kolkata");
$Available=false;
$sql_m;
$BookNoIssue=0;
$b=$_POST["Book_No"];
$m=$_POST["Member_ID"];
$issueBy= $_POST["issuedBy"];
$sql_b="SELECT * from books where Book_No = '$b'";
if($issueBy =="Student"){
    $sql_m="SELECT * from student where Member_ID = '$m'";
}
elseif($issueBy =="Faculty"){
    $sql_m="SELECT * from faculty where Member_ID = '$m'";
}
$result_b = $conn->query($sql_b);
$result_m = $conn->query($sql_m);

if($result_b && $result_m){
    while($row = $result_b->fetch_assoc()){
        if($row["Status"] =="Available"){
            $Available = true;
        }
    }
    if($issueBy =="Student"){
    while($row = $result_m->fetch_assoc()){}
        if($row["Student_Book1"]==null){
            $BookNoIssue = 1;
        }
        elseif($row["Student_Book2"]==null){
            $BookNoIssue = 2;
        }
        elseif($row["Student_Book3"]==null){
            $BookNoIssue = 3;
        }
        else{
            //issueing book limit reached
            $Available = false;
        }
    }
    if($issueBy =="Faculty"){
        while($row = $result_m->fetch_assoc()){}
        if($row["Faculty_Book1"]==null){
            $BookNoIssue = 1;
        }
        elseif($row["Faculty_Book2"]==null){
            $BookNoIssue = 2;
        }
        elseif($row["Faculty_Book3"]==null){
            $BookNoIssue = 3;
        }
        elseif($row["Faculty_Book4"]==null){
            $BookNoIssue = 4;
        }
        elseif($row["Faculty_Book5"]==null){
            $BookNoIssue = 5;
        }
        else{
            //issueing book limit reached
            $Available= false;
        }
    }
    if($Available){
        $sql_ir="INSERT INTO issue_return (Issue_by,Issue_Bookno,Issue_Date)
        values ('$m','$b','$m','$doi');";
        $resultIssue=$conn->query($sql_ir);
        if($resulIssue){
            if($issueBy =="Student"){
                $slot ="Student_Book".$BookNoIssue; 
                $sql_UpdateS="UPDATE student set '$slot'='$b' where Member_ID = '$m';";  
                $update_student = $conn->query($sql_UpdateS);
                $sql_Update = "UPDATE books set Status='$m' where Book_No = $b;";
                $update_book = $conn->query($sql_Update);
            }
            elseif($issueBy == "Faculty"){
                $slot ="Faculty_Book".$BookNoIssue; 
                $sql_UpdateF="UPDATE faculty set '$slot'='$b' where Member_ID = '$m';";  
                $update_faculty = $conn->query($sql_UpdateF);
                $sql_Update = "UPDATE books set Status='$m' where Book_No = $b;";
                $update_book = $conn->query($sql_Update);
            }
            //add an message to show data stored successfully
        }
    }
}
else{
    echo "$conn->error";
}

?>