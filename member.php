<?php
@session_start();
include "auth.php";
date_default_timezone_set("Asia/Kolkata");
$v =verification();
echo $v;
if(!$v)
{
    echo"hola";
    // header("Location: /LibraryManagement/index.php");
}
else
{
    echo "hola again";

    if(filter_input(INPUT_POST,"moption")=="Single Member")
    {
        include "dbconnect.php";
        $memberId = $_POST["memberid"];
        $memberId = strtoupper($memberId);
        $memberId = str_replace("-","",$memberId);
        if(empty($_POST["memberid"]))
        {
            echo "
                <div id='dialog6' style='color:red;' title='⚠️Error'>
                    <p><center>Please enter Member ID</center></p>
                </div>";
        }
        else if(!empty($_POST["memberid"]))
        {
            $member_sql = "SELECT Member_ID from member where Member_ID = '$memberId';";
            $result_m=$conn->query($member_sql);
            $m_count =0;
            while($row=$result_m->fetch_assoc()) $m_count += 1;
        }
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
                    <div id='dialog6' style='color:green;' title='✅Success'>
                        <p><center>Member $memberId has NO-DUES</center></p>
                    </div>";
                }
                else
                {
                    echo "
                    <div id='dialog6' style='color:red;' title='⚠️Error'>
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
        <div id='dialog6' style='color:red;' title='⚠️Error' background: url(alert.png);>
            <p><center>Member Not found</center></p>
        </div>";
    }
    else if(filter_input(INPUT_POST,"moption")=="Class")
    {
        include "dbconnect.php";
        // Include the PDF class
        require_once "FPDF-master/fpdf.php";

        // Create instance of PDF class
        $pdf = new FPDF();
        
        // Add 1 page in your PDF
        $pdf->AddPage();
        $pdf->SetFont("Arial", "B", 22);
        $course =filter_input(INPUT_POST,"course");
        $year =$_POST["year"];
        $year=strval($year);
        if($year[1] == "0") $year[1] = "k";
        $batch =strtoupper($course)."-".$year;
        $sql_m="SELECT * from member;";
        $result_m=$conn->query($sql_m);
        $sql_s = "SELECT Student_Name, Student_Rollno from student where Student_Rollno like '$batch%'";
        $result_s = $conn->query($sql_s);

        $pdf->Cell(70, 10, "Name", 1, 0, "L");
        $pdf->Cell(60, 10, "Roll Number", 1, 0, "L");
        $pdf->Cell(60, 10, "Dues / Nodues", 1, 1, "L");
        $pdf->Ln();
        if($result_s)
        {
            while($row = $result_s->fetch_assoc())
            {
                $checkedm=membercheck($result_m,$row["Student_Rollno"]);
                $result_m->data_seek(0);
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
                            $pdf->Cell(60, 10, "Dues: ".$count, 1, 1, "L");
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
            $destination = __DIR__ . "/Doc/" .'Registratinconfirmed.pdf';
            $pdf->Output($destination,'F');
            echo "<script>window.alert('PDF Downloaded Successfully!!!');</script>";
        }
        else echo $conn->error;
    }
}
?>