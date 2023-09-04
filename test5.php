<?php
echo preg_replace("/[^0-9]/","",'604-619-5135');
include "dbconnect.php";

$max_val=0;
$sql_max_book = "SELECT Book_No from books;";
$res=$conn->query($sql_max_book);
while($row =$res->fetch_assoc())
{
    if((int)preg_replace("/[^0-9]/","",$row["Book_No"]) > $max_val) $max_val = (int)preg_replace("/[^0-9]/","",$row["Book_No"]);
}
echo "\n $max_val";