<?php
@session_start();
include "dbconnect.php";
include "auth.php";
    
    
if(!verification() || $_POST["Access"] != "Main-admin-delete")
{
    header("Location: /LibraryManagement/");
}
else
{
    $flag=0;
    $AdminExist = false;
    $DeleteAuthantication = false;
    $UserName=$_POST["UserName"]; //--------------------------------------------------------ajax dependent
    $sqlcheck="SELECT Username from admin where Username = '$UserName';";
    $resultcheck=$conn->query($sqlcheck);
    if(mysqli_num_rows($resultcheck)==1)
    {
        $AdminExist=true;
        $sqlAdminLev = "SELECT Username from admin where Username = ".$_SESSION["username"]." AND User_level = 'Admin' ;";
        $result = $conn->query($sqlAdminLev);
        if(mysqli_num_rows($result) == 1){
            $DeleteAuthantication = true;
        }
        if($UserName == $_SESSION["username"]){
            $DeleteAuthantication = false;
        }
    }
    else echo $conn->error;
    if($DeleteAuthantication && $AdminExist)
    {
        echo "<div id='dialog-confirm' title='Delete Book ⚠️'>
                    <p><span class='ui-icon ui-icon-alert' style='float:left; margin:12px 12px 20px 0;'></span>Admin $UserName will be permanently deleted and cannot be recovered. Are you sure?</p>
                    </div>";
                echo"<script>
                $( function() {
                  $( '#dialog-confirm' ).dialog({
                    resizable: false,
                    height: 'auto',
                    width: 400,
                    modal: true,
                    buttons: {
                      'Delete Book': function() {
                        $.ajax(
                            {
                                method: 'post',
                                url: 'Admin_delete.php',
                                data: $(this).serialize() + '&Access=' +'Admin-Delete&' +'&UserName=' +'$UserName',
                                datatype: 'text',
                                success: function(Result)
                                {
                                    $( '#dialog' ).dialog( 'destroy' );
                                    $('#response___________________').html(Result);
                                    $('#dialog______________________').dialog();
                                }
                            });
                        $( this ).dialog( 'close' );

                      },
                      Cancel: function() {
                        $( this ).dialog( 'close' );
                      }
                    }
                  });
                } );
                </script>";
    }
    else if(!$AdminExist)
    {
        echo "
        <div id='dialog_______________________' style='color:red;' title='Notification ❌'>
            <p>User Admin does not Exist</p>
        </div>
        "; 
    }
    else if(!$DeleteAuthantication)
    {
        echo "
        <div id='dialog_______________________' style='color:red;' title='Notification ❌'>
            <p>Your User level Does't have authorisation for this Action</p>
        </div>
        "; 
    }
}
?>