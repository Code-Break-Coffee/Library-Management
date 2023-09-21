<?php

include "dbconnect.php";

$search = $_GET["term"];
$sql = "SELECT DISTINCT Title FROM books WHERE Title LIKE '%".$search."%' ORDER BY Title ASC"; 

$bookData = array(); 
$result=$conn->query($sql);
if($result){ 
    while($row = $result->fetch_assoc()){ 
        $Data['value'] = $row['Title']; 
        array_push($bookData, $Data); 
    } 
}

// Return results as json encoded array 
echo json_encode($bookData); 

?>


<!-- $(document).ready(function(){
    $("#book_s").autocomplete({
        autoFocus: true,
        source: "Suggestions.php",
    });
}); -->