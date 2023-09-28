<?php

include "dbconnect.php";

$search = $_GET["term"];
$sql = "SELECT DISTINCT Book_value, category FROM suggestion WHERE Book_value LIKE '%".$search."%' ORDER BY category ASC"; 


$bookData = array(); 
$result=$conn->query($sql);
if($result){ 
    while($row = $result->fetch_assoc()){ 
        if($row["category"] == "Author"){
            $Data['id'] = $row["category"];
            $Data['value'] = $row['Book_value']; 
            array_push($bookData, $Data);    
        }
    }
}

echo json_encode($bookData); 

?>
