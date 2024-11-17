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
        <div id='dialog-confirm' style='color:green;' title='Notification ✅'>
            <p class='notification-success-message'>Book $bookno Deleted Succesfully</p>
        </div>"; 
    else echo $conn->error;
}
echo"<script>
$( function() {
$( '#dialog-confirm' ).dialog({
    resizable: false,
    height: 'auto',
    width: 400,
    modal: true,
    buttons: {
    'Ok': function() {
        $( this ).dialog( 'close' );
    }
    }
});
} );
</script>";
?>