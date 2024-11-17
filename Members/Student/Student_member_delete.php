<?php
    @session_start();
    include "../../connection/dbconnect.php";
    //include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
    include "../../Auth/auth.php";
    if(!verification() || $_POST["Access"] != "Main-delete_member")
    {
        header("Location: /LibraryManagement/");
    }
    $member=$_POST["del_mem"];
    $member = strtoupper($member);
    $member = str_replace("-","",$member);
    $mem_exist=false;
    $stat="DELETE FROM member where Member_ID='$member';";
    $stat_check="SELECT * FROM member where Member_ID='$member';";
    function member_check($s,$m)
    {
        include "../../connection/dbconnect.php";
        $sql_check="SELECT Student_Rollno from student where Student_Rollno = '$m';";
        $result_check=$conn->query($sql_check);
        $r=$conn->query($s);
        if($r && mysqli_num_rows($result_check)== 1)
        {
            while($row=$r->fetch_assoc()){
                if($row["Member_ID"]==$m) 
                {
                    return true;
                }
            }
        }
        return false;
        
    }
    function issue_check($s1,$m)
    {
        include "../../connection/dbconnect.php";
        $r3=$conn->query($s1);
        if($r3)
        {
            while($row=$r3->fetch_assoc()){
                if($row["Issue_By"]==$m) 
                {
                    return true;
                }
            }
        }
        return false;
    }


    if(member_check($stat_check,$member))
    {
        $stat_issue="SELECT Issue_By FROM issue_return where Issue_By='$member' and Return_Date is NULL;";
        if(!issue_check($stat_issue,$member))
        {
            $result=$conn->query($stat);
            if($result)
            {
                echo "
                    <div id='dialog-confirm' style='color:green;' title='✅ Successful'>
                        <p class='notification-success-message'>Member $member Deleted Succesfully</p>
                    </div>"; 
            }
            else
            {
                echo "
                    <div id='dialog-confirm' style='color:red;' title='❌Error'>
                        <p class='notification-message'>$conn->error</p>
                    </div>"; 
            }
        }
        else
        {
            echo "
                <div id='dialog-confirm' style='color:red;' title='❌Error'>
                    <p class='notification-message'>Member $member has a Issued Book</p>
                </div>";
        }
    }
    else
    {
        echo "
        <div id='dialog-confirm' style='color:red;' title='❌Error'>
            <p class='notification-message'>Member $member not found or is not a Student</p>
        </div>
        ";
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