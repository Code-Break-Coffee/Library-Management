<?php
@session_start();
include "auth.php";
if(!verification() || $_POST["Access"] != "Main-Audit" )
{
    header("Location: /LibraryManagement/");
}

date_default_timezone_set("Asia/Kolkata");


$membership=$_POST["membertype"];
$doi_to=$_POST["to"];
$doi_from=$_POST["from"];


function show_table($stat)
{
    include "dbconnect.php";
    $result=$conn->query($stat);
    if($result && mysqli_num_rows($result) > 0)
    {
        echo "
        <div style='width:100%;height:650px;overflow:auto;'><table>
        <tr>
        <th>Issue Bookno</th>
        <th>Issue By</th>
        <th>Issue Date</th>
        <th>Return Date</th>
        </tr>
        <tbody>";
        $count=0;
        while($row=$result->fetch_assoc())
        {
            $count++;
            // if($count>5) break;
            echo"
            <tr>
            <td>".$row["Issue_Bookno"]."</td>
            <td>".$row["Issue_By"]."</td>
            <td>".$row["Issue_Date"]."</td>
            <td>".$row["Return_Date"]."</td>
            </tr>
            ";
        }
        echo "</tbody>
        </table></div>
        <script>
            document.getElementById('aufield').style.transform='translate(-120%,-50%)';
            document.getElementById('response7').style.transform='translate(50%,-90%)';
        </script>";
    }
    else if(mysqli_num_rows($result) <= 0)
        {
            echo "
                <div id='dialog7' style='color:red;' title='⚠️Error' background: url(alert.png);>
                    <p><center>Data not found</center></p>
                </div>";
        }
    else
    {
        echo $conn->error;
    }
}

if($membership=="Student")
{
    $sql_mem="SELECT Issue_Bookno,Issue_By,Issue_Date,Return_Date FROM issue_return 
        where Member_Type='Student' and Issue_Date>='$doi_from' and Issue_Date<='$doi_to' 
            or Return_Date<='$doi_to' and Return_Date>='$doi_from';";
    show_table($sql_mem);
}
else if($membership=="Faculty")
{
    $sql_mem="SELECT Issue_Bookno,Issue_By,Issue_Date,Return_Date FROM issue_return 
        where Member_Type='Faculty' and Issue_Date>='$doi_from' and Issue_Date<='$doi_to' 
            or Return_Date<='$doi_to' and Return_Date>='$doi_from';";
    show_table($sql_mem);
}
else
{
    $sql_mem="SELECT Issue_Bookno,Issue_By,Issue_Date,Return_Date FROM issue_return 
        where Issue_Date>='$doi_from' and Issue_Date<='$doi_to' 
            or Return_Date<='$doi_to' and Return_Date>='$doi_from';";
    show_table($sql_mem);
}
?>