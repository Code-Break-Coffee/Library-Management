<?php
include "dbconnect.php";

$member=1;
$name="Nathkhat teacher";
$course="Assistent";
$type="Faculty";
for($i=0;$i<25;$i++)
{
    if($i<9)
    {
        $sql1="INSERT into member(Member_ID,MemberType) values('FID0".($member+$i)."','$type');";
        $result1=$conn->query($sql1);
        if($result1) echo "$i record added!!!\n";
        else{
         echo $conn->error;
        }
    }
    else
    {
        $sql1="INSERT into member(Member_ID,MemberType) values('FID".($member+$i)."','$type');";
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
        $sql1="INSERT into faculty(Faculty_ID,Faculty_Name,Faculty_Type,Faculty_Fatherorhusband) values('FID0".($member+$i)."','$name','$course','NA');";
        $result1=$conn->query($sql1);
        if($result1) echo "$i record added!!!\n";
        else echo $conn->error;
    }
    else
    {
        $sql1="INSERT into faculty(Faculty_ID,Faculty_Name,Faculty_Type,Faculty_Fatherorhusband) values('FID".($member+$i)."','$name','$course','NA');";
        $result1=$conn->query($sql1);
        if($result1) echo "$i record added!!!\n";
        else echo $conn->error;
    }
}

?>
