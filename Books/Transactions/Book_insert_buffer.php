<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/LibraryManagement/Auth/auth.php";
include "../../connection/dbconnect.php";

if (!verification() || $_POST["Access"] != "Book_add_excel-insert_buffer") {
    header("Location: /LibraryManagement/");
}

function sugesstion_add($title, $author1, $author2, $author3, $publisher)
{
    include "../../connection/dbconnect.php";

    $stat_title_check = "SELECT * FROM suggestion where  Book_value='$title' and category='Title';";
    $stat_publish_check = "SELECT * FROM suggestion where  Book_value='$publisher' and category='Publisher';";

    $res_title = $conn->query($stat_title_check);
    $res_pulish = $conn->query($stat_publish_check);

    if (mysqli_num_rows($res_title) == 0) {
        $stat_title = "INSERT INTO suggestion(Book_value,category) VALUES('$title','Title');";
        $res_append = $conn->query($stat_title);
    }
    if (mysqli_num_rows($res_pulish) == 0) {
        $stat_publish = "INSERT INTO suggestion(Book_value,category) VALUES('$publisher','Publisher');";
        $res_append_publish = $conn->query($stat_publish);
    }

    $arr = array_unique(array($author1, $author2, $author3));
    foreach ($arr as $i) {
        $stat_author_check = "SELECT * FROM suggestion where  Book_value='$i' and category='Author';";
        $res_auth = $conn->query($stat_author_check);
        if (mysqli_num_rows($res_auth) == 0) {
            $stat_author = "INSERT INTO suggestion(Book_value,category) VALUES('$i','Author');";
            $res_append_author = $conn->query($stat_author);
        }
    }
}

$sql = "SELECT * FROM `insert buffer`";
$result_buff = $conn->query($sql);

if (!$result_buff) {
    echo $conn->error;
}

if (mysqli_num_rows($result_buff) > 0) {
    $pdf_count = 0;
    $pdf_arr = array();
    $conn->begin_transaction();

    try {
        while ($row = $result_buff->fetch_assoc()) {
            $sql_book;
            $bookno = $row["val14"];
            $author1 = $row["val1"];
            $author2 = $row["val2"];
            $author3 = $row["val3"];
            $title = $row["val4"];
            $edition = $row["val5"];
            $publisher = $row["val6"];
            $Cl_No = $row["val7"];
            $total_pages = $row["val8"];
            $cost = $row["val9"];
            $supplier = $row["val10"];
            $remark = $row["val11"];
            $billno = $row["val12"];
            $bookcount = $row["val13"];

            $flagcount = 0;
            for ($i = 0; $i < $bookcount; $i++) {
                $bno = $bookno + $i;
                $sql_book = "INSERT into books(Book_No,Author1,Author2,Author3,Title,Edition,Publisher,Cl_No,Total_Pages,Cost,Supplier,Bill_No,Remark) values
                ('$bno','$author1','$author2','$author3','$title','$edition','$publisher',$Cl_No,$total_pages,$cost,'$supplier','$billno','$remark');";
                $result = $conn->query($sql_book);
                array_push($pdf_arr, array($bno, $title));
                sugesstion_add($title, $author1, $author2, $author3, $publisher);

                if ($result) {
                    $flagcount++;
                    $pdf_count++;
                } else {
                    throw new Exception($conn->error);
                }
            }
        }

        require_once "barcode.php";

        $pdf = new PDF_Code128(); // Soham Pdf!!!!!!!!
        $pdf->AddPage();
        $pdf->SetFont("Arial", "B", 18);
        $pdf->SetXY(30, 18); // Adjust the position (x, y) to align with the image

        // Add the text cell
        $pdf->Image($_SERVER['DOCUMENT_ROOT'] . "/LibraryManagement/Assets/img/Davv_Logo.png", 10, 10, 20); // Adjust the position (x, y) and size as needed

        // $pdf->AddFont('LibreBarcode39-Regular','','LibreBarcode39-Regular.php');
        // Set the position for the text cell
        $pdf->Cell(166, 5, 'International Institute of Professional Studies,Davv', 0, 0, 'C');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(166, 5, 'Book Insert Records Excel', 0, 0, 'C');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Cell(70, 10, "Book No", 1, 0, "L");
        $pdf->Cell(60, 10, "Title", 1, 0, "L");
        $pdf->Cell(60, 10, "Bar Code", 1, 0, "L");
        $pdf->Ln();

        for ($i = 0; $i < $pdf_count; $i++) {
            $pdf->Cell(70, 10, $pdf_arr[$i][0], 1, 0, "L");
            $pdf->Cell(60, 10, $pdf_arr[$i][1], 1, 0, "L");
            $barcode = $pdf->Code128($pdf->GetX() + 2, $pdf->GetY() + 1, $pdf_arr[$i][0], 40, 8);
            $pdf->Cell(60, 10, $barcode, 1, 0, "L");
            $pdf->Ln();
        }

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "\LibraryManagement\Doc\insert_book.pdf")) {
            unlink($_SERVER['DOCUMENT_ROOT'] . "\LibraryManagement\Doc\insert_book.pdf");
        }
        $destination = $_SERVER['DOCUMENT_ROOT'] . "\LibraryManagement\Doc\insert_book.pdf";
        $pdf->Output($destination, 'F');

        echo "<script>window.open('/LibraryManagement/Doc/insert_book.pdf','_blank');</script>";

        $sql_delete = "DELETE from `insert buffer`;";
        $result = $conn->query($sql_delete);

        if (!$result) {
            throw new Exception($conn->error);
        }

        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "<div style='color:red;' title='❌Not Allowed'><p><center>Transaction failed: " . $e->getMessage() . "</center></p></div>";
    }
} else {
    echo "<div style='color:red;' title='❌Not Allowed'><p><center>No records found in insert buffer.</center></p></div>";
}
?>
