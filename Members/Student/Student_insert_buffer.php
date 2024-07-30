<?php
include "../../connection/dbconnect.php";


@session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/LibraryManagement/Auth/auth.php";

if (!verification() || $_POST["Access"] != "Main-Book_add_excel") {
    header("Location: /LibraryManagement/");
}


$stat = "SELECT val1, val2, val3, val4 FROM `insert buffer`;";
$result = $conn->query($stat);

if ($result) {
    $sArray = [];
    while ($row = $result->fetch_array()) {
        $sArray[] = $row;
    }

    try {
        // Start transaction
        $conn->begin_transaction();

        for ($i = 0; $i < count($sArray); $i++) {
            $rollno = strtoupper(str_replace("-", "", $sArray[$i][0]));
            $name = $sArray[$i][1];
            $course = $sArray[$i][2];
            $enroll = $sArray[$i][3];

            $stat1 = "INSERT INTO student (Student_Rollno, Student_Name, Student_Course, Student_Enrollmentno) VALUES ('$rollno', '$name', '$course', '$enroll');";
            $res = $conn->query($stat1);

            if (!$res) {
                throw new Exception("Failed to insert student data: " . $conn->error);
            }
        }

        // If all inserts are successful, delete from buffer
        $sql_delete = "DELETE FROM `insert buffer`;";
        $result = $conn->query($sql_delete);

        if (!$result) {
            throw new Exception("Failed to delete from buffer: " . $conn->error);
        }

        // Commit transaction
        $conn->commit();

        echo "
            <div id='dialog_student_excel' style='color:green;' title='Successful'>
                <p><center>Data Inserted Successfully</center></p>
            </div>
        ";

    } catch (Exception $e) {
        // Roll back transaction if any error occurs
        $conn->rollback();
        echo "
            <div id='dialog_student_excel' style='color:red;' title='Error'>
                <p><center>Transaction failed: " . $e->getMessage() . "</center></p>
            </div>
        ";
    }
} else {
    echo "
        <div id='dialog_student_excel' style='color:red;' title='Error'>
            <p><center>Failed to retrieve data from buffer: " . $conn->error . "</center></p>
        </div>
    ";
}
?>