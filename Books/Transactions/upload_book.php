<?php
/* Get the name of the uploaded file */
$filename = $_FILES['file']['name'];

/* Choose where to save the uploaded file */
$location =  "Doc/" .$filename;

/* Save the uploaded file to the local filesystem */
if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
  echo 'Success'; 
  rename("Doc/".$filename,"Doc/book.xlsx");

} 
else 
{ 
  echo 'Failure'; 
}


?>