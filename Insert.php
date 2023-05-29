<?php
echo "tested!!!";
// include "dbconnect.php";
// include "Check.php";

// $sql_mt;

// $m=$_POST["memberid"];
// $MemberType= $_POST["membertype"];
// $MemberName= $_POST["membername"];

// $sql_m="SELECT * from member;";
// $result_m=$conn->query($sql_m);

// if($MemberType =="Student")
// {
//     $SRoll = $_POST["studentroll"];
//     $SCourse = $_POST["studentcourse"];
//     $SEnroll = $_POST["studentenroll"];
//     $sql_mt="SELECT * from student;";
// }
// else if($MemberType =="Faculty")
// {
//     $FId = $_POST["facultyid"];
//     $FRName = $_POST["facultyrname"];
//     $FType = $_POST["facultytype"];
//     $sql_mt="SELECT * from faculty;";
// }
// else echo "fuck off";
// $result_mt = $conn->query($sql_mt);

// if(!membercheck($result_m,$m) && !memberTypeCheck($result_mt,$m,$MemberType))
// {
//     $sql_mAdd="INSERT INTO member (MemberId) VALUES ('$m');";
//     if($MemberType =="Student")
//     {
//         $sql_mTAdd= "INSERT INTO student (Student_Rollno,Student_Name,Student_Course,Student_Enrollmentno) VALUES ('$m','$MemberName','$SCourse','$SCourse','$SEnroll')";
//     }
//     else if($MemberType =="Faculty")
//     {
//         $sql_mTAdd= "INSERT INTO faculty (Faculty_Id,Faculty_Name,Faculty_Type,Faculty_Fatherorhusband) VALUES ('$m','$MemberName','$FType','$FRName')";
//     }
//     $add_m = $conn->query($sql_mAdd);
//     $add_mt = $conn->query($sql_mTAdd);
//     if(!$add_m || !$add_mt)
//     {
//         $conn->error;
//     }

// }
// else
// {
//     echo "Member Already Exists";
// }

?>