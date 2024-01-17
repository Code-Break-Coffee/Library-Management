<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/LibraryManagement/Auth/auth.php";
include "dbconnect.php"; //-------------------------------------------------------------------------------------------------------------------------------------

if (!verification() || $_POST["Access"] != "Book_add_excel-insert_buffer") {
    header("Location: /LibraryManagement/");
}

function sugesstion_add($title, $author1, $author2, $author3, $publisher)
{
    include "dbconnect.php"; //-----------------------------------------------------------------------------------------------------------------------------------

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

$sql = "SELECT * FROM insert buffer";
$result = $conn->query($sql);


if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
        $sql_book;
        $bookno = 0;
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

        $flag = 0;
        if ($flag == 0) {
            $flagcount = 0;
            for ($i = 0; $i < $bookcount; $i++) {
                $bno = $bookno + $i;
                $sql_book = "INSERT into books(Book_No,Author1,Author2,Author3,Title,Edition,Publisher,Cl_No,Total_Pages,Cost,Supplier,Bill_No,Remark) values
            ('$bno','$author1','$author2','$author3','$title','$edition','$publisher',$Cl_No,$total_pages,$cost,'$supplier','$billno','$remark');";
                $result = $conn->query($sql_book);

                sugesstion_add($title, $author1, $author2, $author3, $publisher);

                if ($result) $flagcount++;
                else echo $conn->error;
            }
        }
    }
}
$result->data_seek(0);
