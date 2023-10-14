<?php
 @session_start();
 include "auth.php";
if(!empty($_POST["level"]) || !verification() || $_POST["Access"] != "Main-Admin_display")
{
    $level=$_POST["level"];
    show_table($level);
}
function show_table($l)
{
    include "dbconnect.php";
    $stat="SELECT * FROM admin where User_level = '$l';";
    $result=$conn->query($stat);
    if($result)
    {
        echo "
        <div style='width:100%;height:650px;overflow:auto;'>
        <table>
        <tr>
        <th>User ID</th>
        <th>User Level</th>
        </tr>
        <tbody>";
        $count=1;
        
        while($row=$result->fetch_assoc())
        {
            echo"
            <tr>
            <td>".$row["Username"]."</td>
            <td>".$row["User_level"]."</td>
            </tr>";
            $count++;
        }
        echo "
        </tbody>
        </table>
        </div>
        <script>
            document.getElementById('display').style.transform='translate(-120%,-50%)';
        </script>";
    }
    else
    {
        echo "
        <div id='dialog_admin_disp' style='color:red;' title='⚠️Error'>
            <p><center>$conn->error</center></p>
        </div>
        "; 
    }
}
?>