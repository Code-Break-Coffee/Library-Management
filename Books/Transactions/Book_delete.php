<?php
@session_start();
include "../../connection/dbconnect.php";
//include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
include "../../Auth/auth.php";
if(!verification() || $_POST["Access"] != "Delete-DSucc" )
{
    header("Location: /LibraryManagement/");
}
else
{  
    $bookno = $_POST["bookno"];
    $sql="DELETE from books where Book_No = '$bookno';";
    $result=$conn->query($sql);
    if($result) echo "
        <div id='dialog4' style='color:green;' title='Notification ✅'>
            <p>Book $bookno Deleted Succesfully</p>
        </div>"; 
    else echo $conn->error;
}
?>