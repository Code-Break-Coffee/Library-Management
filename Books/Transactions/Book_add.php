<?php
@session_start();
include "../../connection/dbconnect.php";
include "../../Auth/auth.php";
//include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";


function check($b, $count)
{
    include "../../connection/dbconnect.php";
    for ($i = 0; $i <= $count; $i++) {
        $sql = "SELECT Book_No from books WHERE Book_No = '$b';";
        $res = $conn->query($sql);
        $b += 1;
        if (mysqli_num_rows($res) != 0) return false;
    }
    return true;
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

if (!verification() || $_POST["Access"] != "Main-Insert") {
    header("Location: /LibraryManagement/");
} else {

    $sql;
    $bookno = 0;
    if (!empty($_POST["bookno"])) $bookno = $_POST["bookno"]; //-----------------------------------(book number cast varcare-> num)
    else {
        $sql_max_book = "SELECT Book_No from books;";
        $res = $conn->query($sql_max_book);
        if (!$res) echo "
        <div id='dialog-confirm' style='color:red;' title='⚠️Error'>
            <p class='notification-message'>$conn->error</p>
        </div>
        ";
        while ($row = $res->fetch_assoc()) {
            if ((int)preg_replace("/[^0-9]/", "", $row["Book_No"]) > $bookno) $bookno = (int)preg_replace("/[^0-9]/", "", $row["Book_No"]);
        }
        $bookno += 1;
    }
    $title = $_POST["title"];
    $edition = $_POST["edition"];
    $author1 = $_POST["author1"];
    $author2;
    $author3;
    $publisher = $_POST["publisher"];
    $supplier;
    $cost;
    $total_pages = $_POST["totalpages"];
    $Cl_No = $_POST["CL"];
    $billno;
    $bookcount = 1;
    $remark;
    if (!empty($_POST["author2"])) $author2 = $_POST["author2"];
    else {
        $author2 = null;
    }
    if (!empty($_POST["author3"])) $author3 = $_POST["author3"];
    else {
        $author3 = null;
    }
    if (!empty($_POST["author3"]) && empty($_POST["author2"])) {
        $author2 = $_POST["author3"];
        $author3 = null;
    }
    if ($_POST["remark"] != "null") {
        if ($_POST["remark"] == "others") {
            $remark = $_POST["other"];
        } else {
            $remark = $_POST["remark"];
        }
    } else {
        $remark = NULL;
    }

    if (!empty($_POST["cost"])) $cost = $_POST["cost"];
    else $cost = null;
    if (!empty($_POST["billno"])) $billno = $_POST["billno"];
    else $billno = null;
    if (!empty($_POST["supplier"])) $supplier = $_POST["supplier"];
    else $supplier = null;
    if (!empty($_POST["bookcount"])) $bookcount = $_POST["bookcount"];
    else $bookcount = 1;

    $flag = 0;
    $sqlcheck = "SELECT Book_No from books where Book_No='$bookno';";
    $resultcheck = $conn->query($sqlcheck);
    if ($resultcheck) {
        while ($row = $resultcheck->fetch_assoc()) {
            if ($bookno == $row["Book_No"]) {
                $flag = 1;
                echo "
                <div id='dialog-confirm' style='color:red;' title='⚠️Error'>
                    <p class='notification-message'>Book $bookno Already Present</p>
                </div>
                ";
            }
        }
    } else echo "
    <div id='dialog-confirm' style='color:red;' title='⚠️Error'>
        <p class='notification-message'>$conn->error</p>
    </div>
    ";
    if (!check($bookno, $bookcount) && $flag == 0) {
        echo "
                <div id='dialog-confirm' style='color:red;' title='⚠️Error'>
                    <p class='notification-message'>Book Already Present in the given range</p>
                </div>
                ";
        $flag = 1;
    }
    if ($flag == 0) {
        $pdf_arr = array();
        $flagcount = 0;
        for ($i = 0; $i < $bookcount; $i++) {
            $bno = $bookno + $i;
            // $bno=$bno*(pow(10,8-strlen("$bno")));
            $sql = "INSERT into books(Book_No,Author1,Author2,Author3,Title,Edition,Publisher,Cl_No,Total_Pages,Cost,Supplier,Bill_No,Remark) values
            ('$bno','$author1','$author2','$author3','$title','$edition','$publisher',$Cl_No,$total_pages,$cost,'$supplier','$billno','$remark');";
            $result = $conn->query($sql);
            array_push($pdf_arr, array($bno, $title));
            sugesstion_add($title, $author1, $author2, $author3, $publisher);

            if ($result) $flagcount++;
            else echo $conn->error;
        }

        if ($flagcount == $bookcount) {

            require_once "barcode.php";
            echo "
            <div id='dialog-confirm' style='color:green;' title='✅Successful'>
                <p class='notification-success-message'>$bookcount Books Inserted Successfully</p>
            </div>
            ";

            $pdf = new PDF_Code128();
            $pdf->AddPage();
            $pdf->SetFont("Arial", "B", 18);
            $pdf->Image("../../Assets/img/Davv_Logo.png", 10, 10, 20); // Adjust the position (x, y) and size as needed
            // $pdf->AddFont('LibreBarcode39-Regular','','LibreBarcode39-Regular.php');
            // Set the position for the text cell
            $pdf->SetXY(30, 18); // Adjust the position (x, y) to align with the image

            // Add the text cell
            $pdf->Cell(166, 5, 'International Institute of Professional Studies,Davv', 0, 0, 'C');

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(166, 5, 'Book Insert Records Manual', 0, 0, 'C');
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(70, 10, "Book No", 1, 0, "L");
            $pdf->Cell(60, 10, "Title", 1, 0, "L");
            $pdf->Cell(60, 10, "Bar Code", 1, 0, "L");
            $pdf->Ln();
            for ($i = 0; $i < $bookcount; $i++) {
                $pdf->Cell(70, 10, $pdf_arr[$i][0], 1, 0, "L");
                $pdf->Cell(60, 10, $pdf_arr[$i][1], 1, 0, "L");
                // $pdf->setFont("LibreBarcode39-Regular","",36);
                $barcode = $pdf->Code128($pdf->GetX() + 2, $pdf->GetY() + 1, $pdf_arr[$i][0], 40, 8);
                $pdf->Cell(60, 10, $barcode, 1, 0, "L");

                // Insert the barcode image into the cell
                // $pdf->Image($barcode, $pdf->GetX() + 2, $pdf->GetY() + 2, 56, 14);

                $pdf->Ln();
            }
            if (file_exists("../../Doc/btest.pdf")) {
                unlink("../../Doc/btest.pdf");
            }
            $destination = "../../Doc/btest.pdf";
            $pdf->Output($destination, 'F');

            echo "<script>window.open('/LibraryManagement/Doc/btest.pdf','_blank');</script>";
        } else {
            echo "
            <div id='dialog-confirm' style='color:red;' title='⚠️Error'>
                <p class='notification-message'>Some Error Occured</p>
            </div>
            ";
        }
    }
    echo "<script>
    $( function() {
    $( '#dialog-confirm' ).dialog({
        resizable: false,
        height: 'auto',
        width: 400,
        modal: true,
        buttons: {
        'Ok': function() {
            $( this ).dialog( 'close' );
        }
        }
    });
    } );
    </script>";
}
