<?php

include "dbconnect.php";

if(empty($_POST["bookno"]) || empty($_POST["memberid"]) || empty($_POST["membertype"]))
{
    echo "<script>window.alert('Unauthorized Access or Inputs Not Given!!!');</script>";
    echo "<script>window.alert('Login Again!!!');</script>";
    include "index.html";
}
else
{
date_default_timezone_set("Asia/Kolkata");
$doi = date("Y/m/d");
$Available=true;
$sql_mt;
$b=$_POST["bookno"];
$m=$_POST["memberid"];
$MemberType= $_POST["membertype"];
$sql_b="SELECT Book_No from books where Book_No='$b';";

$sql_m="SELECT * from member where Member_ID ='$m' ;";
$result_m=$conn->query($sql_m);

if($MemberType =="Student")
{
    $sql_mt="SELECT Student_Rollno from student where Student_Rollno = '$m';";
}
else if($MemberType =="Faculty")
{
    $sql_mt="SELECT Faculty_ID from faculty where Member_ID='$m';";
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


// $result_m->data_seek(0);
$checkedb=bookcheck($result_b,$b);
$checkedm=membercheck($result_m,$m);
$checkedmt=memberTypeCheck($result_mt,$m,$MemberType);

if($checkedb)
{
    if($checkedm && $checkedmt)
    {
        if($result_b && $result_m)
        {
            if($Available)
            {
                $sql_ir="INSERT INTO issue_return (Issue_By,Member_Type,Issue_Bookno,Issue_Date)
                values ('$m','$MemberType','$b','$doi');";
                $resultIssue=$conn->query($sql_ir);
                if($resultIssue)
                {
                    $sql_UpdateB = "UPDATE books set Status='$m' where Book_No = $b;";
                    $update_book = $conn->query($sql_UpdateB);

                    if($update_book) echo"Book issued by $m successfully";
                    else echo $conn->error;
                }
                else
                {
                    echo $conn->error;
                }        
            }
            else
            {
                echo "Issue for Book not Allowed!!!";
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

}
?>
