<?php
@session_start();
include "dbconnect.php";
include "Auth\\auth.php";
if(!verification() || $_POST["Access"] != "Main-Membership" )
{
    header("Location: /LibraryManagement/");
}
else
{
    $roll=$_POST["roll_no"];
    
    $roll=strtoupper($roll);
    $roll=str_replace("-","",$roll);

    $stat="INSERT INTO member (Member_ID,MemberType) values ('$roll','Student');";
    $stat2="SELECT * FROM student where Student_Rollno='$roll';";
    $stat3="SELECT * FROM member where Member_ID='$roll';";
    $result_student_check=$conn->query($stat2);
    $result_member_check=$conn->query($stat3);
    if(mysqli_num_rows($result_student_check)>0)
    {
        if(mysqli_num_rows($result_member_check)>0)
        {
            echo "
            <div id='dialog8' style='color:red;' title='Error'>
                <p><center>Member Already Present</center></p>
            </div>";
        }
        else
        {
            $result=$conn->query($stat);
            echo "
            <div id='dialog8' style='color:green;' title='Successfull'>
                <p><center>$roll Added Successfully</center></p>
            </div>
            ";
        }
    }
    else
    {
        echo "
            <div id='dialog8' style='color:red;' title='Error'>
                <p><center>Student not found in Records</center></p>
            </div>";
    }
}

?>