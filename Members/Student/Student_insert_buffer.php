<?php
include "../../connection/dbconnect.php";

@session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/LibraryManagement/Auth/auth.php";

if (!verification() || $_POST["Access"] != "Main-Book_add_excel") {
    header("Location: /LibraryManagement/");
    exit;
}

$stat = "SELECT val1, val2, val3, val4 FROM `insert buffer`;";
$result = $conn->query($stat);

if ($result) {
    while ($row = $result->fetch_array()) {
        $sArray[] = $row;
    }

    $conn->begin_transaction(); // Start transaction

    try {
        for ($i = 0; $i < count($sArray); $i++) {
            $rollno = strtoupper(str_replace("-", "", $sArray[$i][0]));
            $name = $sArray[$i][1];
            $course = $sArray[$i][2];
            $enroll = $sArray[$i][3];
            $stat1 = "INSERT INTO student(Student_Rollno, Student_Name, Student_Course, Student_Enrollmentno) VALUES ('$rollno', '$name', '$course', '$enroll');";
            $res = $conn->query($stat1);
            if (!$res) {
                throw new Exception($conn->error);
            }
        }

        $sql_delete = "DELETE FROM `insert buffer`;";
        $result = $conn->query($sql_delete);
        if (!$result) {
            throw new Exception($conn->error);
        }

        $conn->commit(); // Commit transaction
        echo "
            <div id='dialog_student_excel' style='color:green;' title='Successful'>
                <p><center>Data Inserted Successfully</center></p>
            </div>;
        ";
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaction on error
        echo "<div id='dialog_student_excel' style='color:red;' title='Error'><p><center>Transaction failed: " . $e->getMessage() . "</center></p></div>";
    }
} else {
    echo "<div id='dialog_student_excel' style='color:red;' title='Error'><p><center>No records found in insert buffer.</center></p></div>";
}
?>
