<?php
    include "dbconnect.php";
    $member=$_POST["del_mem"];
    $course=$_POST["del_course"];
    $mem_exist=false;
    $stat="DELETE FROM member where Member_ID='$member';";
    $stat_check="SELECT * FROM member where Member_ID='$member';";
    function member_check($s,$m)
    {
        include "dbconnect.php";
        $r=$conn->query($s);
        if($r)
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
        include "dbconnect.php";
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
        $mem ="";
        $stat_check2="SELECT Member_ID FROM member where Member_ID='$member';";
        $r1=$conn->query($stat_check2);
        while($row=$r1->fetch_assoc()) $mem =$row["Member_ID"];
        $stat_issue="SELECT Issue_By FROM issue_return where Issue_By='$member' and Return_Date is NULL;";
        if(!issue_check($stat_issue,$member))
        {
            if(substr($mem,0,2)==$course)
            {
                $result=$conn->query($stat);
                if($result)
                {
                    echo "
                        <div id='dialog_del' style='color:green;' title='✅ Successful'>
                            <p>Member $member Deleted Succesfully</p>
                        </div>"; 
                }
                else
                {
                    echo "
                        <div id='dialog_del' style='color:red;' title='❌Error'>
                            <p>$conn->error</p>
                        </div>"; 
                }
            }
            else
            {
                echo "
                    <div id='dialog_del' style='color:red;' title='❌Error'>
                        <p>Member $member And Course Do Not Match</p>
                    </div>";
            }
        }
        else
        {
            echo "
                <div id='dialog_del' style='color:red;' title='❌Error'>
                    <p>Member $member has a Issued Book</p>
                </div>";

        }
    }
    else
    {
        echo "
        <div id='dialog_del' style='color:red;' title='❌Error'>
            <p>Member $member not found</p>
        </div>
        ";
    }
    
?>