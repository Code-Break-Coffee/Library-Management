<?php
echo preg_replace("/[^0-9]/","",'604-619-5135');
include "dbconnect.php";

$sql_max_book = "SELECT MAX(Book_No)as bno_max from books;";
$res=$conn->query($sql_max_book);
while($row =$res->fetch_assoc())
{
    $bookno = (int)$row["bno_max"];
}
echo "\n $bookno";