<?php
require_once('vendor/autoload.php');
include "../../connection/dbconnect.php";


use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$flag = 1;
$targetPath = $_SERVER['DOCUMENT_ROOT'] . '/LibraryManagement/Doc/faculty.xlsx';

$Reader = new Xlsx();
$spreadSheet = $Reader->load($targetPath);
$excelSheet = $spreadSheet->getActiveSheet();
$spreadSheetAry = $excelSheet->toArray();
$sheetCount = count($spreadSheetAry);
$incorrect_rows = "";
for ($i = 1; $i < $sheetCount; $i++) {

    $fac_id = $spreadSheetAry[$i][0];
    $fac_name = $spreadSheetAry[$i][1];
    $fac_type = $spreadSheetAry[$i][2];
    $id_check = "SELECT * FROM faculty where Faculty_ID='$fac_id';";
    $result_check = $conn->query($id_check);
    if (mysqli_num_rows($result_check) == 0) {
        if (!empty($fac_id) && !empty($fac_name) && !empty($fac_type)) {
            $sql = "INSERT INTO faculty (Faculty_ID,Faculty_Name,Faculty_Type) VALUES ('$fac_id','$fac_name','$fac_type');";
            $result = $conn->query($sql);
        } else {
            $incorrect_rows = $incorrect_rows . " $i";
        }
    } else {
        echo "
            <div id='dialog_exl_faculty' style='color:green;' title='✅Successful'>
                <p><center>duplicate record found member already exists</center></p>
            </div>
            ";
        break;
    }
}
// print confirmation table and user confirm button ---zakie
if (strlen($incorrect_rows) == 0) {
    echo "
        <div id='dialog_exl_faculty' style='color:green;' title='✅Successful'>
            <p><center>All Faculty Data Inserted Successfully</center></p>
        </div>
        ";
}
if (strlen($incorrect_rows) > 0) {
    echo "
        <div id='dialog_exl_faculty' style='color:green;' title='✅Successful'>
            <p><center>$incorrect_rows rows not inserted. Rest Inserted</center></p>
        </div>
        ";
} else {
    echo "
        <div id='dialog_exl_faculty' style='color:green;' title='✅Successful'>
            <p><center>$conn->error</center></p>
        </div>
        ";
}
