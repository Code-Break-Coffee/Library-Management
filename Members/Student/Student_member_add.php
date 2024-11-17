<?php
@session_start();
include "../../connection/dbconnect.php";
//include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
include "../../Auth/auth.php";
if(!verification() || $_POST["Access"] != "Main-Membership" )
{
    header("Location: /LibraryManagement/");
}
else
{
    $roll=$_POST["roll_no"];
    
    $roll=strtoupper($roll);
    $roll=str_replace("-","",$roll);

    $stat="INSERT INTO member (Member_ID,MemberType) values ('$roll','Student');";
    $stat2="SELECT * FROM student where Student_Rollno='$roll';";
    $stat3="SELECT * FROM member where Member_ID='$roll';";
    $result_student_check=$conn->query($stat2);
    $result_member_check=$conn->query($stat3);
    if(mysqli_num_rows($result_student_check)>0)
    {
        if(mysqli_num_rows($result_member_check)>0)
        {
            echo "
            <div id='dialog-confirm' style='color:red;' title='Error'>
                <p class='notification-message'>Member Already Present</p>
            </div>";
        }
        else
        {
            $result=$conn->query($stat);
            echo "
            <div id='dialog-confirm' style='color:green;' title='Successfull'>
                <p class='notification-success-message'>$roll Added Successfully</p>
            </div>
            ";
        }
    }
    else
    {
        echo "
            <div id='dialog-confirm' style='color:red;' title='Error'>
                <p class='notification-message'>Student not found in Records</center></p>
            </div>";
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
}

?>