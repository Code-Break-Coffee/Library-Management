<?php
@session_start();
//include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
include "../../Auth/auth.php";
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
        $memberId = preg_replace('/[^A-Za-z0-9]/', '', $memberId);
        if(empty($_POST["memberid"]))
        {
            echo "
                <div id='dialog-confirm' style='color:red;' title='⚠️Error'>
                <p style='display: flex; align-items: center; justify-content: center; background-color: #f9e6e6; color: #a72828; padding: 1rem; border-radius: 8px; border: 1px solid #a72828; max-width: 400px; margin: 20px auto; font-weight: bold;'>
                        <span class='ui-icon ui-icon-alert' style='margin-right: 8px;'></span>
                        Please Enter Member ID
                    </p>  
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
                        echo "
                        <div id='dialog-confirm' title='Notification ⚠️'>
                            <p style='display: flex; align-items: center; justify-content: center; background-color: #e6f9e6; color: #28a745; padding: 1rem; border-radius: 8px; border: 1px solid #28a745; max-width: 400px; margin: 20px auto; font-weight: bold;'>
                                <span class='ui-icon ui-icon-check' style='margin-right: 8px;'></span>
                            $memberId has no book dues!
                            </p>
                        </div>";
                    }
                    else
                    {
                        echo "
                        <div id='dialog-confirm' style='color:red;' title='⚠️Notification'>
                            <p style='display: flex; align-items: center; justify-content: center; background-color: #f9e6e6; color: #a72828; padding: 1rem; border-radius: 8px; border: 1px solid #a72828; max-width: 400px; margin: 20px auto; font-weight: bold;'>
                                <span class='ui-icon ui-icon-alert' style='margin-right: 8px;'></span>
                                Member $memberId has $count Books Dues
                            </p>
                        </div>";
                    }
                }
                else echo "
                <div id='dialog6' style='color:red;' title='⚠️Error'>
                    <p><center>$conn->error</center></p>
                </div>";
            }
            else echo "
            <div id='dialog-confirm' style='color:red;' title='❌Not Found'>
                <p style='display: flex; align-items: center; justify-content: center; background-color: #f9e6e6; color: #a72828; padding: 1rem; border-radius: 8px; border: 1px solid #a72828; max-width: 400px; margin: 20px auto; font-weight: bold;'>
                    <span class='ui-icon ui-icon-alert' style='margin-right: 8px;'></span>
                    Member $memberId Not Found
                </p>
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
    else if(filter_input(INPUT_POST,"moption")=="Class")
    {
        include "../../connection/dbconnect.php";
        // Include the PDF class
        require_once "../../FPDF-master/fpdf.php";
        class PDF extends FPDF
        {
            function Footer()
            {
                $this->SetY(-15);
                $this->SetFont("Arial","B",15);
                $this->Cell(0,1,"Signature",0,0,"R");
            }
        }
        // Create instance of PDF class
        $pdf = new PDF();
        
        // Add 1 page in your PDF
        $pdf->AddPage();
        $pdf->SetFont("Arial", "B", 18);

        
        $year =$_POST["year"];
        $year=strtoupper($year);
        $year=str_replace("-","",$year);
        
        $sql_s = "SELECT Student_Name, Student_Rollno from student where Student_Rollno like '$year%' order by Student_Rollno;";
        $result_s = $conn->query($sql_s);
        $pdf->Image( "../../Assets/img/Davv_Logo.png", 10, 10, 20); // Adjust the position (x, y) and size as needed

        // Set the position for the text cell
        $pdf->SetXY(30, 18); // Adjust the position (x, y) to align with the image

        // Add the text cell
        $pdf->Cell(166, 5, 'International Institute of Professional Studies,Davv', 0, 0, 'C');

        $pdf->Ln(); 
        $pdf->Ln(); 
        $pdf->Ln(); 
        $pdf->Ln(); 
        $pdf->Ln(); 
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
            if (file_exists("../../Doc/Registratinconfirmed.pdf")) {   
                unlink("../../Doc/Registratinconfirmed.pdf");
            }
            $destination = "../../Doc/Registratinconfirmed.pdf";
            $pdf->Output($destination,'F');
            
            echo "<script>window.open('/LibraryManagement/Doc/Registratinconfirmed.pdf','_blank');</script>";
        }
        else echo $conn->error;
    }
}
?>