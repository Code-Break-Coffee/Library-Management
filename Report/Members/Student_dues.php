<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
function membercheck($x,$y)
{
    include "../../connection/dbconnect.php";
    if($x)
    {
        while($row=$x->fetch_assoc())
        {
            if($row["Member_ID"] == $y)
            {
                return true;
            }
        }
    }
    
    return false;
}
if(!verification() || $_POST["Access"] != "Main-member" )
{
    header("Location: /LibraryManagement/");
}
else
{
    date_default_timezone_set("Asia/Kolkata");
    $m_count =0;
    if(filter_input(INPUT_POST,"moption")=="Single Member")
    {
        include "../../connection/dbconnect.php";
        $memberId = $_POST["memberid"];
        $memberId = strtoupper($memberId);
        $memberId = str_replace("-","",$memberId);
        if(empty($_POST["memberid"]))
        {
            echo "
                <div id='dialog6' style='color:red;' title='⚠️Error'>
                    <p><center>Please enter authentic Member ID</center></p>
                </div>";
            
        }
        else if(!empty($_POST["memberid"]))
        {
            $member_sql = "SELECT Member_ID from member where Member_ID = '$memberId';";
            $result_m=$conn->query($member_sql);
            while($row=$result_m->fetch_assoc()) $m_count += 1;
            $sql="SELECT * from issue_return where Issue_By = '$memberId' and Return_Date is null;";
            $result=$conn->query($sql);
            $count=0;
            if($m_count > 0)
            {
                if($result)
                {
                    while($row=$result->fetch_assoc()) $count += 1;
                    if($count==0)
                    {
                        echo "<div id='dialog-confirm' title='Remove Membership ⚠️'>
                    <p><span class='ui-icon ui-icon-alert' style='float:left; margin:12px 12px 20px 0;'></span> 
                    $memberId has no Book Dues!!!<br>
                    Member $memberId will be removed from members!!! Are you sure?</p>
                    </div>";
                echo"<script>
                $( function() {
                  $( '#dialog-confirm' ).dialog({
                    resizable: false,
                    height: 'auto',
                    width: 400,
                    modal: true,
                    buttons: {
                      'Remove Membership': function() {
                        $.ajax(
                            {
                                method: 'post',
                                url: 'Members\\Student\\Student_member_delete.php',
                                data: $(this).serialize() + '&Access=Main-delete_member&del_mem=$memberId',
                                datatype: 'text',
                                success: function(Result)
                                {
                                    $( '#dialog_del' ).dialog( 'destroy' );
                                    $('#response6').html(Result);
                                    $('#dialog_del').dialog();
                                }
                            });
                        $( this ).dialog( 'close' );

                      },
                      'Cancel': function() {
                        $( this ).dialog( 'close' );
                      }
                    }
                  });
                } );
                </script>";
                    }
                    else
                    {
                        echo "
                        <div id='dialog6' style='color:red;' title='⚠️Notification'>
                            <p><center>Member $memberId has $count Books Dues</center></p>
                        </div>";
                    }
                }
                else echo "
                <div id='dialog6' style='color:red;' title='⚠️Error'>
                    <p><center>$conn->error</center></p>
                </div>";
            }
            else echo "
            <div id='dialog6' style='color:red;' title='❌Not Found'>
                <p><center>Member Not found</center></p>
            </div>";
        }
    }
    else if(filter_input(INPUT_POST,"moption")=="Class")
    {
        include "../../connection/dbconnect.php";
        // Include the PDF class
        require_once $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/FPDF-master/fpdf.php";

        // Create instance of PDF class
        $pdf = new FPDF();
        
        // Add 1 page in your PDF
        $pdf->AddPage();
        $pdf->SetFont("Arial", "B", 22);
        $year =$_POST["year"];
        $year=strtoupper($year);
        $year=str_replace("-","",$year);
        
        $sql_s = "SELECT Student_Name, Student_Rollno from student where Student_Rollno like '$year%' order by Student_Rollno;";
        $result_s = $conn->query($sql_s);

        $pdf->Cell(70, 10, "Name", 1, 0, "L");
        $pdf->Cell(60, 10, "Roll Number", 1, 0, "L");
        $pdf->Cell(60, 10, "Dues / Nodues", 1, 1, "L");
        $pdf->Ln();
        if($result_s)
        {
            while($row = $result_s->fetch_assoc())
            {
                $sr=$row["Student_Rollno"];
                $sql_m="SELECT * from member WHERE Member_ID ='$sr';";
                $result_m=$conn->query($sql_m);
                $checkedm=membercheck($result_m,$row["Student_Rollno"]);
                if($checkedm)
                {

                    $count = 0;
                    $id =$row["Student_Rollno"];
                    $issue_sql = "SELECT * from issue_return where Return_Date is NULL and Issue_By ='$id'";
                    $issue_result = $conn->query($issue_sql);
                    if($issue_result)
                    {
                        while ($issue_row = $issue_result->fetch_assoc())
                        {
                            $count += 1;
                        }
                        if($count != 0)
                        {
                            // dues $count
                            $pdf->Cell(70, 10, $row["Student_Name"], 1, 0, "L");
                            $pdf->Cell(60, 10, $row["Student_Rollno"], 1, 0, "L");
                            $pdf->Cell(60, 10, "Dues : ".$count, 1, 1, "L");
                        }
                        else
                        {
                            // nodues
                            $pdf->Cell(70, 10, $row["Student_Name"], 1, 0, "L");
                            $pdf->Cell(60, 10, $row["Student_Rollno"], 1, 0, "L");
                            $pdf->Cell(60, 10, "No Dues", 1, 1, "L");
                        }
                    }
                    else echo $conn->error;
                }
                else
                { 
                    // nodues
                    $pdf->Cell(70, 10, $row["Student_Name"], 1, 0, "L");
                    $pdf->Cell(60, 10, $row["Student_Rollno"], 1, 0, "L");
                    $pdf->Cell(60, 10, "No Dues", 1, 1, "L");
                }
            }
            if (file_exists($_SERVER['DOCUMENT_ROOT']."\LibraryManagement\Doc\Registratinconfirmed.pdf")) {   
                unlink($_SERVER['DOCUMENT_ROOT']."\LibraryManagement\Doc\Registratinconfirmed.pdf");
            }
            $destination = $_SERVER['DOCUMENT_ROOT']."\LibraryManagement\Doc\Registratinconfirmed.pdf";
            $pdf->Output($destination,'F');
            
            echo "<script>window.open('/LibraryManagement/Doc/Registratinconfirmed.pdf','_blank');</script>";
        }
        else echo $conn->error;
    }
}
?>