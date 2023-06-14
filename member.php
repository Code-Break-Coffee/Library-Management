<?php

date_default_timezone_set("Asia/Kolkata");
if(empty($_POST["bookno"]) && empty($_POST["author"]) && empty($_POST["title"]))
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
        $sql="SELECT * from issue_return where Issue_By = $memberId and Return_Date =null;";
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
        $course ="IT-";
        $year ="2k21-";
        $batch =$course.$year;
        $record = array();
        $sql_m="SELECT * from member;";
        $result_m=$conn->query($sql_m);
        $sql_s = "SELECT Student_Rollno from student where Student_Rollno like '$batch'.'%'";
        $result_s = $conn->query($sql_s);
        if($result_s)
        {
            while($row = $result_s->fetch_assoc())
            {
                $result_m->data_seek(0);
                $checkedm=membercheck($result_m,$m);
                if($checkedm)
                {
                    $count = 0;
                    $issue_sql = "SELECT * from issue_return where Return_Date = NULL";
                    $issue_result = $conn->query($issue_sql);
                    if($issue_result)
                    {
                        while ($issue_row = $issue_result->fetch_assoc())
                        {
                            $count += 1;
                        }
                        if($count != 0)
                        {
                            $record[] = $row;
                            $record[$row] = $count." DUES";
                        }
                        else
                        {
                            $record[] = $row;
                            $record[$row] = "NODUES";
                        }
                    }
                    else echo $conn->error;
                }
                else
                {
                    $record[] = $row;
                    $record[$row] = "NODUES";
                }
            }
        }
        else echo $conn->error;
    }
   
}
?>