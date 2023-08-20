<?php

include "dbconnect.php";

date_default_timezone_set("Asia/Kolkata");
$doi = date("Y/m/d");
$Available=true;
$sql_mt;
if(empty($_POST["bookno"]) || empty($_POST["memberid"]) || empty($_POST["membertype"]))
{
    echo "<script>window.alert('Unauthorized Access or Inputs Not Given!!!');</script>";
    include "index.php";
}
else
{
    $b=$_POST["bookno"];
    $m=$_POST["memberid"];
    $MemberType= $_POST["membertype"];
    $sql_b="SELECT * from books;";
    $Allowed=true;

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
    $checkedb=bookcheck($result_b,$b,$m);
    $checkedm=membercheck($result_m,$m);
    $checkedmt=memberTypeCheck($result_mt,$m,$MemberType);

    if($checkedb)
    {
        if($checkedm && $checkedmt)
        {
            if($result_b && $result_m)
            {
                if($Allowed)
                {
                    $sql_ir="UPDATE books set Status='Available' where Book_No = $b;";
                    
                    $sql_ret="UPDATE issue_return set Return_Date= '$doi' where Return_Date is NULL and Issue_Bookno= $b;";
                    $resultReturn=$conn->query($sql_ret);
                    $resultIssue=$conn->query($sql_ir);
                    if($resultIssue && $resultReturn)
                    {
                        echo "
                        <div id='dialog2' style='color:green;' title='Success'>
                            <p><center>Book Issue Successfully!!</center></p>
                        </div>
                        "; 
                    }
                    else
                    {
                        echo "<div style='position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%); color: red;'><center>$conn->error</center></div>";
                    }        
                }
                else
                {
                    echo "
                    <div id='dialog2' style='color:red;' title='Not Allowed'>
                        <p><center>Book $b Return Not Allowed!!</center></p>
                    </div>
                    "; 
                }
            }
            else
            {
                echo "<div style='position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%); color: red;'><center>$conn->error</center></div>";
            }
        }
        else
        {
            echo "<div id='dialog2' style='color:red;' title='notification'>
                    <p><center>Member $m not found</center></p>
                </div>";
        }
    }
    else
    {
        echo "
        <div id='dialog2' style='color:red;' title='notification'>
            <p><center>Book $b is not issued or $m is Incorrect</center></p>
        </div>
        "; 
    }
}
?>