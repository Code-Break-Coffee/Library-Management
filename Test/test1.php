<?php
include "../connection/dbconnect.php";

$member=1;
$name="Nathkhat Kothari";
$course="MTech IT [5yrs]";
$type="Student";
for($i=0;$i<25;$i++)
{
    if($i<9)
    {
        $sql1="INSERT into member(Member_ID,MemberType) values('IT2K210".($member+$i)."','$type');";
        $result1=$conn->query($sql1);
        if($result1) echo "$i record added!!!\n";
        else{
         echo $conn->error;
        }
    }
    else
    {
        $sql1="INSERT into member(Member_ID,MemberType) values('IT2K21".($member+$i)."','$type');";
        $result1=$conn->query($sql1);
        if($result1) echo "$i record added!!!\n";
        else echo $conn->error;
    }
}
$member=1;
for($i=0;$i<75;$i++)
{
    if($i<9)
    {
        $sql1="INSERT into student(Student_Rollno,Student_Name,Student_Course,Student_Enrollmentno) values('IT2K210".($member+$i)."','$name','$course','DE210200".($member+$i)."');";
        $result1=$conn->query($sql1);
        if($result1) echo "$i record added!!!\n";
        else echo $conn->error;
    }
    else
    {
        $sql1="INSERT into student(Student_Rollno,Student_Name,Student_Course,Student_Enrollmentno) values('IT2K21".($member+$i)."','$name','$course','DE21020".($member+$i)."');";
        $result1=$conn->query($sql1);
        if($result1) echo "$i record added!!!\n";
        else echo $conn->error;
    }
}

?>
