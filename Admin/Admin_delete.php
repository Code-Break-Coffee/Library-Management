<?php
@session_start();
include "../connection/dbconnect.php";
include "../Auth/auth.php";
//include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
if(!verification(1) || $_POST["Access"] != "Admin-Delete" )
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

    if($result && $resultTemp){ echo "
        <div id='dialog-confirm' style='color:green;' title='Notification ✅'>
            <p class='notification-success-message'>Admin $UserName Record Deleted Succesfully</p>
        </div>"; 
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
    }
    else echo $conn->error;
}

?>