<?php

include "dbconnect.php";

date_default_timezone_set("Asia/Kolkata");
$doi = date("Y/m/d");
$Available=true;
$sql_mt;
$BookNoIssue=1;
$b=$_POST["Bookno"];
$m=$_POST["memberid"];
$MemberType= $_POST["membertype"];
$sql_b="SELECT * from books;";

$sql_m="SELECT * from member;";
$result_m=$conn->query($sql_m);

if($MemberType =="Student")
{
    $sql_mt="SELECT * from student;";
}
else if($MemberType =="Faculty")
{
    $sql_mt="SELECT * from faculty;";
}
$result_b = $conn->query($sql_b);
$result_mt = $conn->query($sql_mt);

function bookcheck($x,$y)
{
    if($x)
    {
        while($row=$x->fetch_assoc())
        {
            if($row["Book_No"] == $y && $row["Status"] == "Available")
            {
                return true;
            }
        }
    }
    return false;
}

function membercheck($x,$y)
{
    if($x)
    {
        while($row=$x->fetch_assoc())
        {
            if($row["Member_ID"] == $y)
            {
                return true;
            }
        }
    }
    return false;
}
function memberTypeCheck($x,$y,$z)
{
    if($x && $z =="Student")
    {
        while($row=$x->fetch_assoc())
        {
            if($row["Student_Rollno"] == $y)
            {
                return true;
            }
        }
    }
    else if($x && $z == "Faculty")
    {
        while($row=$x->fetch_assoc())
        {
            if($row["Faculty_ID"] == $y)
            {
                return true;
            }
        }
    }
    return false;
}


$result_m->data_seek(0);
$checkedb=bookcheck($result_b,$b);
$checkedm=membercheck($result_m,$m);
$checkedmt=memberTypeCheck($result_mt,$m,$MemberType);

if($checkedb)
{
    if($checkedm && $checkedmt)
    {
        if($result_b && $result_m)
        {
            $result_m->data_seek(0);
            while($row=$result_m->fetch_assoc())
            {
                if($row["Member_ID"]== $m)
                {
                    if($row["Book_Issue1"]==null)
                    {
                        $BookNoIssue = 1;
                    }
                    else if($row["Book_Issue2"]==null)
                    {
                        $BookNoIssue = 2;
                    }
                    else if($row["Book_Issue3"]==null)
                    {
                        $BookNoIssue = 3;
                    }
                    else if($row["Book_Issue4"]==null)
                    {
                        $BookNoIssue = 4;
                    }
                    else if($row["Book_Issue5"]==null)
                    {
                        $BookNoIssue = 5;
                    }
                    else if($row["Book_Issue6"]==null)
                    {
                        $BookNoIssue = 6;
                    }
                    else if($row["Book_Issue7"]==null)
                    {
                        $BookNoIssue = 7;
                    }
                    else if($row["Book_Issue8"]==null)
                    {
                        $BookNoIssue = 8;
                    }
                    else if($row["Book_Issue9"]==null)
                    {
                        $BookNoIssue = 9;
                    }
                    else if($row["Book_Issue10"]==null)
                    {
                        $BookNoIssue = 10;
                    }
                    else
                    {
                        echo "Book issue limit reached for $m";
                        $Allowed = false;
                    }
                }
            }
            if($Allowed)
            {
                $sql_ir="INSERT INTO issue_return (Issue_By,Member_Type,Issue_Bookno,Issue_Date)
                values ('$m','$MemberType','$b','$doi');";
                $resultIssue=$conn->query($sql_ir);
                if($resultIssue)
                {
                    $slot ="Book_Issue".$BookNoIssue; 
                    $sql_UpdateM="UPDATE member set $slot=$b where Member_ID = '$m';";  
                    $update_member = $conn->query($sql_UpdateM);

                    $sql_UpdateB = "UPDATE books set Status='$m' where Book_No = $b;";
                    $update_book = $conn->query($sql_UpdateB);

                    if($update_book && $update_member) echo"Book issued by $m successfully";
                    else echo $conn->error;
                }
                else
                {
                    echo $conn->error;
                }
            }
            else
            {
                echo "Book $b not Available!!!";
            }
        }
        else
        {
            echo $conn->error;
        }
    }
    else
    {
        echo "Member $m not found!!!";
    }
}
else
{
    echo "Book $b is not Available!!!";
}

?>