<?php

date_default_timezone_set("Asia/Kolkata");

if(empty(filter_input(INPUT_POST,"moption")))
{
    echo "<script>window.alert('Unauthorized Access or Inputs Not Given!!!');</script>";
    include "index.html";
}

else
{

    if(filter_input(INPUT_POST,"moption")=="Single Member")
    {
        include "dbconnect.php";
        $memberId = $_POST["memberid"];
        $sql="SELECT * from issue_return where Issue_By = '$memberId' and Return_Date is null;";
        $result=$conn->query($sql);
        $count=0;
        if($result)
        {
            while($row=$result->fetch_assoc()) $count += 1;
            if($count==0)
            {
                echo "Member $memberId has NODUES"; 
            }
            else
            {
                echo "Member $memberId has $count Books Dues";
            }
        }
        else echo $conn->error;
    }
    else if(filter_input(INPUT_POST,"moption")=="Class")
    {
        include "dbconnect.php";
        include "Check.php";
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