<?php
@session_start();
include "../../connection/dbconnect.php";
include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
if(!verification() || $_POST["Access"] != "Main-Issue" )
{
    header("Location: /LibraryManagement/");
}
else
{
date_default_timezone_set("Asia/Kolkata");
$doi = date("Y/m/d");
$Available=true;
$sql_mt;
$b=$_POST["bookno"];
$m=$_POST["memberid"];
$m = strtoupper($m);
$m = str_replace("-","",$m);
$MemberType= $_POST["membertype"];
$sql_b="SELECT Book_No,Status from books where Book_No='$b';";

$sql_m="SELECT * from member where Member_ID ='$m' ;";
$result_m=$conn->query($sql_m);

if($MemberType =="Student")
{
    $sql_mt="SELECT Student_Rollno from student where Student_Rollno = '$m';";
}
else if($MemberType =="Faculty")
{
    $sql_mt="SELECT Faculty_ID from faculty where Faculty_ID='$m';";
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

function issueLimit($s)
{
    $sql="SELECT Issue_Limit from issue_limit;";
    $result=$GLOBALS["conn"]->query($sql);
    $check="SELECT Book_No from books where Status = '$s';";
    $check_result=$GLOBALS["conn"]->query($check);
    if($check_result)
    {
        if($result)
        {
            $row=$result->fetch_array();
            if(mysqli_num_rows($check_result)>=$row["Issue_Limit"])
            {
                $GLOBALS["Available"]=false;
            }
        }
    }
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
            if($MemberType=="Student")
            {
                issueLimit($m);
            }
            if($Available)
            {
                $sql_ir="INSERT INTO issue_return (Issue_By,Member_Type,Issue_Bookno,Issue_Date)
                values ('$m','$MemberType','$b','$doi');";
                $resultIssue=$conn->query($sql_ir);
                if($resultIssue)
                {
                    $sql_UpdateB = "UPDATE books set Status='$m' where Book_No = '$b';";
                    $update_book = $conn->query($sql_UpdateB);

                    if($update_book)echo "
                    <div id='dialog1' style='color:green;' title='✅Successful'>
                        <p><center>Book Issued By Member $m Succesfull!</center></p>
                    </div>
                    "; 
                    else echo "<div style='position:relative;top:50%;left:50%;transform:translate(-50%, -50%);color:red;'><center>$conn->error</center></div>";
                }
                else
                {
                    echo "<div style='position:relative;top:50%;left:50%;transform:translate(-50%, -50%);color:red;'><center>$conn->error</center></div>";
                }        
            }
            else
            {
                echo "
                <div id='dialog1' style='color:red;' title='⚠️Error'>
                    <p><center>Book Issue Not Allowed!!</center></p>
                </div>
                "; 
            }
        }
        else
        {
            echo "<div style='position:relative;top:50%;left:50%;transform:translate(-50%, -50%);color:red;'><center>$conn->error</center></div>";
        }
    }
    else
    {
        echo "
        <div id='dialog1' style='color:red;' title='⚠️Member Not Found'>
            <p><center>Member $m Not Found</center></p>
        </div>
        "; 
    }
}
else
{
    echo "
    <div id='dialog1' style='color:red;' title='⚠️Book Not Available'>
        <p><center>Book $b Is Not Availabe</center></p>
    </div>
    "; 
}

}
?>
