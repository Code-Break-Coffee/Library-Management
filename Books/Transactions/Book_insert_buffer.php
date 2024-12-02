<?php
@session_start();
include "../../Auth/auth.php";
//include $_SERVER['DOCUMENT_ROOT'] . "/LibraryManagement/Auth/auth.php";
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
            foreach ($row as $key => $value) {
                $row[$key] = preg_replace("/'/", "\\'", $value);
            }
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
        
        // Add the logo and headers
        $pdf->Image("../../Assets/img/Davv_Logo.png", 10, 10, 20);
        $pdf->SetXY(30, 18);
        $pdf->Cell(0, 10, 'International Institute of Professional Studies, Davv', 0, 1, 'C');
        $pdf->Cell(0, 10, 'Book Insert Records Excel', 0, 1, 'C');
        $pdf->Ln(10);
        
        // Define column headers and widths
        $header = ["Book No", "Title", "Bar Code"];
        $colWidths = [60, 70, 60]; // Total width = 190 (A4 page width - margins)
        $pdf->SetFont("Arial", "B", 12);
        
        // Add the table header
        foreach ($header as $key => $col) {
            $pdf->Cell($colWidths[$key], 10, $col, 1, 0, "L");
        }
        $pdf->Ln();
        
        // Add rows dynamically
        $pdf->SetFont("Arial", "", 10);
        for ($i = 0; $i < $pdf_count; $i++) {
            $startY = $pdf->GetY(); // Get the starting Y position of the row
        
            // Check if the current Y position will overflow onto the next page
            if ($pdf->GetY() > 250) { // Near the bottom of the page
                $pdf->AddPage(); // Add a new page to continue printing
                $pdf->SetFont("Arial", "B", 12); // Reset font for header after page break
                foreach ($header as $key => $col) { // Reprint the header on the new page
                    $pdf->Cell($colWidths[$key], 10, $col, 1, 0, "L");
                }
                $pdf->Ln(); // Move to the next row
            }
        
            // Book No
            $pdf->Cell($colWidths[0], 10, $pdf_arr[$i][0], 1, 0, "L");
        
            // Title (wrapped using MultiCell)
            $titleX = $pdf->GetX();
            $titleY = $pdf->GetY();
            $pdf->MultiCell($colWidths[1], 10, $pdf_arr[$i][1], 1, "L");
            $endY = $pdf->GetY(); // Get the ending Y position after MultiCell
        
            // Adjust height for "Bar Code" to match the tallest cell in the row
            $rowHeight = $endY - $startY; // Calculate the height of the row
            $pdf->SetXY($titleX + $colWidths[1], $startY); // Move the cursor to the next column
        
            // Bar Code
            $barcodeX = $pdf->GetX();
            $barcodeY = $pdf->GetY();
            $pdf->Code128($barcodeX + 2, $barcodeY + 1, $pdf_arr[$i][0], 40, 8); // Draw the barcode
            $pdf->Cell($colWidths[2], $rowHeight, '', 1, 0, "L");
        
            $pdf->Ln(); // Move to the next row
        }

        if (file_exists("../../Doc/insert_book.pdf")) {
            unlink("../../Doc/insert_book.pdf");
        }
        $destination = "../../Doc/insert_book.pdf";
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
