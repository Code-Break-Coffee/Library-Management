<?php
include "dbconnect.php";

$doi = date("Y/m/d");
date_default_timezone_set("Asia/Kolkata");
$sql_m;
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
    if($issueBy =="Student"){
        while($row = $result_m->fetch_assoc()){}
        if($row["Student_Book1"]=='$b'){
            $BookNoIssue = 1;
            }
            elseif($row["Student_Book2"]=='$b'){
                $BookNoIssue = 2;
            }
            elseif($row["Student_Book3"]=='$b'){
                $BookNoIssue = 3;
            }
            else{
                //incorrect 
            }
        }
        if($issueBy =="Faculty"){
            while($row = $result_m->fetch_assoc()){}
            if($row["Faculty_Book1"]=='$b'){
                $BookNoIssue = 1;
            }
            elseif($row["Faculty_Book2"]=='$b'){
                $BookNoIssue = 2;
            }
            elseif($row["Faculty_Book3"]=='$b'){
                $BookNoIssue = 3;
            }
            elseif($row["Faculty_Book4"]=='$b'){
                $BookNoIssue = 4;
            }
            elseif($row["Faculty_Book5"]=='$b'){
                $BookNoIssue = 5;
            }
            else{
                //incorrect
            }
        }
        if($issueBy =="Student"){
            $slot ="Student_Book".$BookNoIssue; 
            $sql_UpdateS="UPDATE student set '$slot'=null where Member_ID = '$m';";  
            $update_student = $conn->query($sql_UpdateS);
            
        }
        elseif($issueBy == "Faculty"){
            $slot ="Faculty_Book".$BookNoIssue; 
            $sql_UpdateF="UPDATE faculty set '$slot'=null where Member_ID = '$m';";  
            $update_faculty = $conn->query($sql_UpdateF);
            
        }
        $sql_Update = "UPDATE books set Status='Available' where Book_No = $b;";
        $update_book = $conn->query($sql_Update);
        
    }