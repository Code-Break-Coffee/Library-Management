<?php
echo "tested!!!";
// include "dbconnect.php";

// date_default_timezone_set("Asia/Kolkata");
// $dor = date("Y/m/d");
// $sql_m;
// $b=$_POST["bookno"];
// $m=$_POST["memberid"];
// $ReturnedBy= $_POST["membertype"];
// $sql_b="SELECT * from books;";

// $sql_check="SELECT * from member;";
// $result_check=$conn->query($sql_check);

// if($ReturnedBy =="Student")
// {
//     $sql_m="SELECT * from student;";
// }
// else if($ReturnedBy =="Faculty")
// {
//     $sql_m="SELECT * from faculty;";
// }

// $result_b = $conn->query($sql_b);
// $result_m = $conn->query($sql_m);


// function bookcheck($x,$y,$m)
// {
//     if($x)
//     {
//         while($row=$x->fetch_assoc())
//         {
//             if($row["Book_No"] == $y && $row["Status"] == $m)
//             {
//                 return true;
//             }
//         }
//     }
//     return false;
// }


// function membercheck($x,$y)
// {
//     if($x)
//     {
//         while($row=$x->fetch_assoc())
//         {
//             if($row["Member_ID"] == $y)
//             {
//                 return true;
//             }
//         }
//     }
//     return false;
// }
// function memberTypeCheck($x,$y,$z)
// {
//     if($x && $z =="Student")
//     {
//         while($row=$x->fetch_assoc())
//         {
//             if($row["Student_Rollno"] == $y)
//             {
//                 return true;
//             }
//         }
//     }
//     else if($x && $z == "Faculty")
//     {
//         while($row=$x->fetch_assoc())
//         {
//             if($row["Faculty_ID"] == $y)
//             {
//                 return true;
//             }
//         }
//     }
//     return false;
// }


// function shuffel($r,$m)
// {
//     include "dbconnect.php";
//     $updated = false;
//     $memb = ($r == "Student") ? "Student_Book" : "Faculty_Book";
//     $sql = ($r == "Student") ? "SELECT * from student where Student_Rollno = '$m';" : "SELECT * from faculty where Faculty_ID = '$m';";
//     $id=($r == "Student") ? "Student_Rollno" : "Faculty_ID";
//     $table=($r == "Student") ? "student" : "faculty";
//     $lim = ($r == "Student") ? 3 : 5;
//     $result = $conn->query($sql);
//     while($row = $result->fetch_assoc())
//     {
//         for($i=1; $i<$lim; $i++)
//         {
//             if($row[$memb.$i] == null || $updated )
//             {
//                 $col = "$memb".$i;
//                 $colNext = "$memb".($i+1);
//                 $next = $row[$memb.($i+1)];
//                 $Update="UPDATE $table set $col ='$next' where $id = '$m';";  
//                 $update = $conn->query($Update); 
//                 $UpdateNext="UPDATE $table set $colNext =null where $id = '$m';";  
//                 $updateNext = $conn->query($UpdateNext); 
//                 if(!$update) echo $conn->error;
//                 if(!$updateNext) echo $conn->error;
//                 $updated = true;
//             }
//         }
//     }
//     $result->data_seek(0);  
// }
 
// $result_m->data_seek(0);
// $checkedb=bookcheck($result_b,$b,$m);
// $checkedm=membercheck($result_check,$m);
// $checkedmt=memberTypeCheck($result_m,$m,$ReturnedBy);

// if($checkedb)
// {
//     if($checkedm && $checkedmt)
//     {
//         if($result_b && $result_m)
//         {
//             $result_m->data_seek(0);
//             if($ReturnedBy =="Student")
//             {
//                 while($row = $result_m->fetch_assoc())
//                 {
//                     if($row["Student_Rollno"]== $m)
//                     {
    
//                         if($row["Student_Book1"]==$b)
//                         {
//                             $BookNoIssue = 1;
//                         }
//                         else if($row["Student_Book2"]==$b)
//                         {
//                             $BookNoIssue = 2;
//                         }
//                         else if($row["Student_Book3"]==$b)
//                         {
//                             $BookNoIssue = 3;
//                         }
//                         else{
//                             echo $conn->error;
//                         }
//                     }
//                 }
//             }
//             $result_m->data_seek(0);
//             if($ReturnedBy =="Faculty")
//             {
//                 while($row = $result_m->fetch_assoc())
//                 {
//                     if($row["Faculty_ID"]== $m)
//                     {
//                         if($row["Faculty_Book1"]==$b)
//                         {
//                             $BookNoIssue = 1;
//                         }
//                         else if($row["Faculty_Book2"]==$b)
//                         {
//                             $BookNoIssue = 2;
//                         }
//                         else if($row["Faculty_Book3"]==$b)
//                         {
//                             $BookNoIssue = 3;
//                         }
//                         else if($row["Faculty_Book4"]==$b)
//                         {
//                             $BookNoIssue = 4;
//                         }
//                         else if($row["Faculty_Book5"]==$b)
//                         {
//                             $BookNoIssue = 5;
//                         }
//                         else
//                         {
//                             echo $conn->error;
//                         }
//                     }
//                 }
//             }
//             if($ReturnedBy =="Student")
//             {
//                 $slot ="Student_Book".$BookNoIssue; 
//                 $sql_UpdateS="UPDATE student set $slot=null where Student_Rollno = '$m';";  
//                 $update_student = $conn->query($sql_UpdateS);
//                 if(!$update_student) echo $conn->error;
//             }
//             if($ReturnedBy == "Faculty")
//             {
//                 $slot ="Faculty_Book".$BookNoIssue; 
//                 $sql_UpdateF="UPDATE faculty set $slot=null where Faculty_ID = '$m';";  
//                 $update_faculty = $conn->query($sql_UpdateF);   
//                 if(!$update_faculty) echo $conn->error;
//             }
//             $sql_Update = "UPDATE books set Status='Available' where Book_No = $b;";
//             $update_book = $conn->query($sql_Update);
//             $sql_return = "UPDATE issue_return set Return_Date = '$dor' where Issue_Bookno=$b and Return_Date is null and Issue_By='$m';";
//             $update_return = $conn->query($sql_return);
//             if($update_return)
//             {
//                 if($update_book)
//                 {
//                     shuffel($ReturnedBy,$m);
//                     echo "Book $b returned successfully by Member $m !!!";
//                 }
//                 else echo $conn->error;
//             }   
//             else echo $conn->error;
//         }
//         else
//         {
//             echo $conn->error;
//         }
//     }
//     else
//     {
//         echo "Member $m not found!!!";
//     }
// }
// else
// {
//     echo "Book $b is not issued!!!";
// }
?>
