<?php
/* Get the name of the uploaded file */
$filename = $_FILES['file']['name'];

/* Choose where to save the uploaded file */
$location =  $_SERVER['DOCUMENT_ROOT'].'/LibraryManagement/Doc/'.$filename;

/* Save the uploaded file to the local filesystem */
if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
  echo 'Success'; 
  rename($location,$_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Doc/book.xlsx");

} 
else 
{ 
  echo 'Failure'; 
}

?>