<?php
include "dbconnect.php";

$sql = "SELECT * FROM `insert buffer`";
$result = $conn->query($sql);

if(!$result){
    echo $conn->error;
}
if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
        print_r($row) ;
        // $sql_book;
        // $bookno = 0;
        // $bookno = $row["val14"];
        // $author1 = $row["val1"];
        // $author2 = $row["val2"];
        // $author3 = $row["val3"];
        // $title = $row["val4"];
        // $edition = $row["val5"];
        // $publisher = $row["val6"];
        // $Cl_No = $row["val7"];
        // $total_pages = $row["val8"];
        // $cost = $row["val9"];
        // $supplier = $row["val10"];
        // $remark = $row["val11"];
        // $billno = $row["val12"];
        // $bookcount = $row["val13"];

        // $flag = 0;
        // if ($flag == 0) {
        //     $flagcount = 0;
        //     for ($i = 0; $i < $bookcount; $i++) {
        //         $bno = $bookno + $i;
        //         $sql_book = "INSERT into books(Book_No,Author1,Author2,Author3,Title,Edition,Publisher,Cl_No,Total_Pages,Cost,Supplier,Bill_No,Remark) values
        //     ('$bno','$author1','$author2','$author3','$title','$edition','$publisher',$Cl_No,$total_pages,$cost,'$supplier','$billno','$remark');";
        //         $result = $conn->query($sql_book);

        //         sugesstion_add($title, $author1, $author2, $author3, $publisher);

        //         if ($result) $flagcount++;
        //         else echo $conn->error;
        //     }
        // }
        // if($flagcount==$bookcount){
        //     echo "yeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeehg";
        // }
    }
}
$result->data_seek(0);