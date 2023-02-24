<?php
include "dbconnect.php";

date_default_timezone_set("Asia/Kolkata");
$dor = date("Y/m/d");
$sql_m;
$b=$_POST["Book_No"];
$m=$_POST["Member_ID"];
$ReturnedBy= $_POST["ReturnedBy"];
$sql_b="SELECT * from books;";

if($ReturnedBy =="Student")
{
    $sql_m="SELECT * from student;";
}
else if($ReturnedBy =="Faculty")
{
    $sql_m="SELECT * from faculty;";
}

$result_b = $conn->query($sql_b);
$result_m = $conn->query($sql_m);


function bookcheck($x,$y,$m)
{
    if($x)
    {
        while($row=$x->fetch_assoc())
        {
            if($row["Book_No"] == $y && $row["Status"] == $m)
            {
                return true;
            }
        }
    }
    return false;
}

$result_m->data_seek(0);
$checkedb=bookcheck($result_b,$b,$m);

if($checkedb)
{
    if($result_b && $result_m)
    {
        $result_m->data_seek(0);
        if($ReturnedBy =="Student")
        {
            while($row = $result_m->fetch_assoc())
            {
                if($row["Student_Book1"]==$b)
                {
                    $BookNoIssue = 1;
                }
                else if($row["Student_Book2"]==$b)
                {
                    $BookNoIssue = 2;
                }
                else if($row["Student_Book3"]==$b)
                {
                    $BookNoIssue = 3;
                }
                else{
                    echo $conn->error;
                }
            }
        }
        $result_m->data_seek(0);
        if($ReturnedBy =="Faculty")
        {
            while($row = $result_m->fetch_assoc())
            {
                if($row["Faculty_Book1"]==$b)
                {
                    $BookNoIssue = 1;
                }
                else if($row["Faculty_Book2"]==$b)
                {
                    $BookNoIssue = 2;
                }
                else if($row["Faculty_Book3"]==$b)
                {
                    $BookNoIssue = 3;
                }
                else if($row["Faculty_Book4"]==$b)
                {
                    $BookNoIssue = 4;
                }
                else if($row["Faculty_Book5"]==$b)
                {
                    $BookNoIssue = 5;
                }
                else
                {
                    echo $conn->error;
                }
            }
        }
        if($ReturnedBy =="Student")
        {
            $slot ="Student_Book".$BookNoIssue; 
            $sql_UpdateS="UPDATE student set $slot=null where Student_Rollno = '$m';";  
            $update_student = $conn->query($sql_UpdateS);
            if(!$update_student) echo $conn->error;
        }
        if($ReturnedBy == "Faculty")
        {
            $slot ="Faculty_Book".$BookNoIssue; 
            $sql_UpdateF="UPDATE faculty set $slot=null where Faculty_ID = '$m';";  
            $update_faculty = $conn->query($sql_UpdateF);   
            if(!$update_faculty) echo $conn->error;
        }
        $sql_Update = "UPDATE books set Status='Available' where Book_No = $b;";
        $update_book = $conn->query($sql_Update);
        $sql_return = "UPDATE issue_return set Return_Date = '$dor' where Issue_By = '$m'";
        $update_return = $conn->query($sql_return);
        if($update_return && $update_book) echo "Book $b returned successfully by Member $m !!!";
        else echo $conn->error;
    }
    else
    {
        echo $conn->error;
    }
}
else
{
    echo "Book $b is not issued!!!";
}
