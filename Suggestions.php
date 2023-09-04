<?php

include "dbconnect.php";

$search = $_GET["term"];
$search = $_GET["Category"];
$sql = "SELECT Book_value,category FROM suggestion WHERE Book_value LIKE '%".$search."%' ORDER BY category ASC;"; 

$bookData = array(); 
$result=$conn->query($sql);
if($result){ 
    while($row = $result->fetch_assoc()){ 
        $Data['label'] = $row['Book_value']; 
        $Data['category'] = $row['category']; 
        array_push($bookData, $Data); 
    } 
}else $conn->error;
 
// Return results as json encoded array 
echo json_encode($bookData); 

?>