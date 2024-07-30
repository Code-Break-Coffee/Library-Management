<?php
include "../../connection/dbconnect.php";


@session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/LibraryManagement/Auth/auth.php";

if (!verification() || $_POST["Access"] != "Main-Book_add_excel") {
    header("Location: /LibraryManagement/");
}


$stat = "select val1,val2,val3,val4 from `insert buffer`;";
$result = $conn->query($stat);

if ($result) {
    while ($row = $result->fetch_array()) {
        $sArray[] = $row;
    }

    for ($i = 0; $i < count($sArray); $i++) {
        $rollno = $sArray[$i][0];
        $rollno = strtoupper($rollno);
        $rollno = str_replace("-", "", $rollno);
        $name = $sArray[$i][1];
        $course = $sArray[$i][2];
        $enroll = $sArray[$i][3];
        $stat1 = "insert into student(Student_Rollno,Student_Name,Student_Course,Student_Enrollmentno) values ('$rollno','$name','$course','$enroll');";
        $res = $conn->query($stat1);
        if ($res) {
            echo "
                <div id='dialog_student_excel' style='color:green;' title='Succesfull'>
                    <p><center>Data Inserted Successfully</center></p>
                </div>;
                ";
            $sql_delete = "DELETE from `insert buffer`;";
            $result = $conn->query($sql_delete);
        } else {
            echo "error";
        }
    }
}
