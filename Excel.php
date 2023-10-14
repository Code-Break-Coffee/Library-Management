<?php
// echo"<script> window.alert('hi');</script>";
use PhpSpreadsheet\Reader\Xlsx;

include "dbconnect.php";

    print_r($_FILES["file1"]["name"]);
    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file1"]["name"], $allowedFileType)) {

        $targetPath = 'uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file1']['tmp_name'], $targetPath);

        $Reader = new \PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        for ($i = 1; $i <= $sheetCount; $i ++) {
            $bno = "";
            if (isset($spreadSheetAry[$i][0])) {
                $bno = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
            }
            $author1 = "";
            if (isset($spreadSheetAry[$i][1])) {
                $author1 = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
            }
            $author2 = "";
            if (isset($spreadSheetAry[$i][2])) {
                $author2 = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
            }
            $author3 = "";
            if (isset($spreadSheetAry[$i][3])) {
                $author3 = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]);
            }
            $title = "";
            if (isset($spreadSheetAry[$i][4])) {
                $title = mysqli_real_escape_string($conn, $spreadSheetAry[$i][4]);
            }
            $edition = "";
            if (isset($spreadSheetAry[$i][5])) {
                $edition = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]);
            }
            $publisher = "";
            if (isset($spreadSheetAry[$i][6])) {
                $publisher = mysqli_real_escape_string($conn, $spreadSheetAry[$i][6]);
            }

            $Cl_No=$spreadSheetAry[$i][7];
            $total_pages=$spreadSheetAry[$i][8];
            $cost=$spreadSheetAry[$i][9];


            $supplier = "";
            if (isset($spreadSheetAry[$i][10])) {
                $supplier = mysqli_real_escape_string($conn, $spreadSheetAry[$i][10]);
            }

            $billno = "";
            if (isset($spreadSheetAry[$i][11])) {
                $billno = mysqli_real_escape_string($conn, $spreadSheetAry[$i][11]);
            }
            if (! empty($bno) || ! empty($author1) ||!empty($author2)|| ! empty($author3) ||!empty($title)) {      //pura kar isko furture wale zakie
                $sql="INSERT into books(Book_No,Author1,Author2,Author3,Title,Edition,Publisher,Cl_No,Total_Pages,Cost,Supplier,Bill_No) values
            ('$bno','$author1','$author2','$author3','$title','$edition','$publisher',$Cl_No,$total_pages,$cost,'$supplier','$billno');";
            $result=$conn->query($sql);
                // $query = "insert into tbl_info(name,description) values(?,?)";
                // $paramType = "ss";
                // $paramArray = array(
                //     $name,
                //     $description
                // );
                // $insertId = $db->insert($query, $paramType, $paramArray);
                // $query = "insert into tbl_info(name,description) values('" . $name . "','" . $description . "')";
                // $result = mysqli_query($conn, $query);

                if ($result) {
                    echo "
                    <div id='dialog_exl_disp' style='color:green;' title='✅Successful'>
                        <p><center>Books Inserted Successfully</center></p>
                    </div>
                    ";
                } else {
                    echo "
                    <div id='dialog_exl_disp' style='color:green;' title='✅Successful'>
                        <p><center>$conn->error</center></p>
                    </div>
                    ";
                }
            }
        }
    } else {
        echo "
        <div id='dialog_exl_disp' style='color:green;' title='✅Successful'>
            <p><center>$conn->error</center></p>
        </div>
        ";
    }


?>