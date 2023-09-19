<?php
@session_start();
include "dbconnect.php";
include "auth.php";
if(!verification() || $_POST["Access"] != "Admin-Delete" )
{
    header("Location: /LibraryManagement/");
}
else
{  
    $UserName = $_POST["UserName"];
    $sql="DELETE from admin where Username = '$UserName';";
    $result=$conn->query($sql);

    $sqlTemp="DELETE from temp_keys where Username = '$UserName';";
    $resultTemp=$conn->query($sqlTemp);
    
    if($result && $resultTemp) echo "
        <div id='dialog4' style='color:green;' title='Notification ✅'>
            <p>Admin $UserName Record Deleted Succesfully</p>
        </div>"; 
    else echo $conn->error;
}
?>