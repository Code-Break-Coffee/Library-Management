<?php
include "../../connection/dbconnect.php";

$stat = "SELECT val1, val2, val3 FROM `insert buffer`;";
$result = $conn->query($stat);

if ($result) {
    while ($row = $result->fetch_array()) {
        $sArray[] = $row;
    }

    $conn->begin_transaction(); // Start transaction

    try {
        for ($i = 0; $i < count($sArray); $i++) {
            $fcaId = $sArray[$i][0];
            $fcaId = strtoupper($fcaId);
            $fcaId = str_replace("-", "", $fcaId);
            $fName = $sArray[$i][1];
            $fType = $sArray[$i][2];

            $stat1 = "INSERT INTO faculty(Faculty_ID,Faculty_Name,Faculty_Type) VALUES ('$fcaId','$fName','$fType');";
            $res = $conn->query($stat1);
            $stat2="INSERT into member(Member_ID,MemberType) values('$facId','Faculty');";
            $res2=$conn->query($stat2);
            if (!$res || !$res2) {
                throw new Exception($conn->error);
            }
        }

        $sql_delete = "DELETE FROM `insert buffer`;";
        $result = $conn->query($sql_delete);
        if (!$result) {
            throw new Exception($conn->error);
        }

        $conn->commit(); // Commit transaction
        echo "<div style='color:green;' title='Successful'><p><center>Data Inserted Successfully</center></p></div>";
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaction on error
        echo "<div style='color:red;' title='Error'><p><center>Transaction failed: " . $e->getMessage() . "</center></p></div>";
    }
} else {
    echo "<div style='color:red;' title='Error'><p><center>No records found in insert buffer.</center></p></div>";
}
?>
