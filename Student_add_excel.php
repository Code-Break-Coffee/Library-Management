<?php
require_once ('vendor/autoload.php');
include "dbconnect.php";
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$targetPath = 'Doc/student.xlsx';
$Reader = new Xlsx();
$spreadSheet = $Reader->load($targetPath);
$excelSheet = $spreadSheet->getActiveSheet();
$spreadSheetAry = $excelSheet->toArray();
$sheetCount = count($spreadSheetAry);

function check($sArray,$sCount)
{
    for($i=1;$i<$sCount;$i++)
    {
        $rollno=$sArray[$i][0];
        $rollno=strtoupper($rollno);
        $rollno=str_replace("-","",$rollno);
        $name=$sArray[$i][1];
        $course=$sArray[$i][2];
        $enroll=$sArray[$i][3];
        if(empty($rollno) || empty($name) || empty($course) || empty($enroll))
        {
            return false;
        }
    }
    return true;
}

if(check($spreadSheetAry,$sheetCount))
{
    for($i=1;$i<$sheetCount;$i++)
    {
        $rollno=$spreadSheetAry[$i][0];
        $rollno=strtoupper($rollno);
        $rollno=str_replace("-","",$rollno);
        $name=$spreadSheetAry[$i][1];
        $course=$spreadSheetAry[$i][2];
        $enroll=$spreadSheetAry[$i][3];
        $sql_check="SELECT Student_Rollno from student where Student_Rollno = '$rollno';";
        $result_check=$conn->query($sql_check);
        if($result_check)
        {
            if(mysqli_num_rows($result_check)>0)
            {
                echo "<script>window.alert(`'$rollno' is already present in the students' data, other all data will be added!!!`);</script>";
            }
            else
            {
                $sql="INSERT into student(Student_Rollno,Student_Name,Student_Course,Student_Enrollmentno)
                values('$rollno','$name','$course','$enroll');";
                $result=$conn->query($sql);
                if(!$result)
                {
                    echo
                    "
                        <div id='dialog_exl_disp_student' style='color:red;' title='❌Error'>
                            <p><center>There was en error in the excel data format in the row of Roll No '$rollno'.
                            Rows after this record will not be inserted!!! Please reupload the excel.</center></p>
                        </div>
                    ";
                    break;
                }
            }
        }
        else
        {
            echo
            "
                <div id='dialog_exl_disp_student' style='color:red;' title='❌Error'>
                    <p><center>An Error Occurred!!!</center></p>
                </div>
            ";
            break;
        }
    }
}
else
{
    echo
    "
        <div id='dialog_exl_disp_student' style='color:red;' title='❌Not Allowed'>
            <p><center>An Excel Field is Empty!!!</center></p>
        </div>
    ";
}
?>