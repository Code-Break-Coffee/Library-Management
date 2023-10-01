<?php
@session_start();
include "auth.php";
function membercheck($x,$y)
{
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
if(!verification() ){// chaining not done ------------------------------------------------------------------------
}
else
{
    date_default_timezone_set("Asia/Kolkata");
    
    include "dbconnect.php";
    $batch = $_POST["Roll"];
    $sql_s = "SELECT Student_Name, Student_Rollno from student where Student_Rollno like '$batch%' order by Student_Rollno;";
    $result_s = $conn->query($sql_s);
    $records =[];
    
    if($result_s)
    {
        while($row = $result_s->fetch_assoc())
        {
            $sql_m="SELECT * from member WHERE Student_Rollno =".$row["Student_Rollno"].";";
            $result_m=$conn->query($sql_m);
            $checkedm=membercheck($result_m,$row["Student_Rollno"]);
            $result_m->data_seek(0);
            if($checkedm){
                $records[$row["Student_Rollno"]] = array($row["Student_Name"], $row["Student_Course"], $row["Student_Enrollmentno"],"Member");
            }
            $records[$row["Student_Rollno"]] = array($row["Student_Name"], $row["Student_Course"], $row["Student_Enrollmentno"],"Not a Member");

        }
        displayTable($records);
    }
}

function displayTable($records)
    {
        if(count($records) > 0)
        {
            
        
            echo "
                <div style='width:100%;overflow:auto;height:650px;'><table>
                <tr>
                    <th>Roll No.</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Enrollment No.</th>
                    <th>Membership</th>
                </tr>
                <tbody>";

            foreach($records as $roll=>$data)
            {
                echo"
                <tr>
                    <td>".$roll."</td>
                    <td>".$data[0]."</td>
                    <td>".$data[1]."</td>
                    <td>".$data[2]."</td>
                    <td>".$data[3]."</td>
                <td></td>
                <td></td>
                </tr>
                ";
            }

            echo"
                </tbody></table></div>
                <script>
                    document.getElementById('SearchField').style.transform='translate(-120%,-50%)';
                    document.getElementById('response5').style.top='25%';
                    document.getElementById('response5').style.left='45%';
                </script>";

        }
        else
        {
            echo "
                <div id='dialog' style='color:red;' title='⚠️Error' background: url(alert.png);>
                    <p><center>Book data not found</center></p>
                </div>";
        }
    }
?>