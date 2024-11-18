<?php
@session_start();
//include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
include "../../Auth/auth.php";

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
                    document.getElementById('std_searchField').style.transform='translate(-90%,0%)';
                    document.getElementById('response_student_records').style.top='25%';
                    document.getElementById('response_student_records').style.left='45%';
                </script>";

        }
        else
        {
            echo "
                <div id='dialog-confirm' style='color:red;' title='⚠️Error'>
                        <p style='display: flex; align-items: center; justify-content: center; background-color: #f9e6e6; color: #a72c28; padding: 1rem; border-radius: 8px; border: 1px solid #a72828; max-width: 400px; margin: 20px auto; font-weight: bold;'>
                            <span class='ui-icon ui-icon-check' style='margin-right: 8px;'></span>
                            Member Not Found
                        </p>
                </div>";
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
    }
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
if(!verification() || $_POST["Access"] != "Main-Student_members_details")
    {
        header("Location: /LibraryManagement/");
    }
else
{
    date_default_timezone_set("Asia/Kolkata");
    
    include "../../connection/dbconnect.php";
    $batch = $_POST["batch_id"];
    $batch=strtoupper($batch);
    $batch=preg_replace('/[^A-Za-z0-9]/', '', $batch);
    $sql_s = "SELECT * from student where Student_Rollno like '$batch%' order by Student_Rollno;";
    $result_s = $conn->query($sql_s);
    $records =[];
    
    if($result_s)
    {
        while($row = $result_s->fetch_assoc())
        {
            $id = $row["Student_Rollno"];
            $sql_m="SELECT * from member WHERE Member_ID ='$id';";
            $result_m=$conn->query($sql_m);
            echo $conn->error;
            $checkedm=membercheck($result_m,$row["Student_Rollno"]);
            
            if($checkedm){
                $records[$row["Student_Rollno"]] = array($row["Student_Name"], $row["Student_Course"], $row["Student_Enrollmentno"],"Member");
            }
            else{
                $records[$row["Student_Rollno"]] = array($row["Student_Name"], $row["Student_Course"], $row["Student_Enrollmentno"],"Not a Member");
            }

        }
        displayTable($records);
    }
    else{
        echo"<div id='dialog-confirm' style='color:red;' title='⚠️Error'>
                        <p style='display: flex; align-items: center; justify-content: center; background-color: #f9e6e6; color: #a72c28; padding: 1rem; border-radius: 8px; border: 1px solid #a72828; max-width: 400px; margin: 20px auto; font-weight: bold;'>
                            <span class='ui-icon ui-icon-check' style='margin-right: 8px;'></span>
                            $conn->error
                        </p>
            </div>";
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
}


?>