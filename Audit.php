<?php
@session_start();
include "auth.php";
if(!verification())
{
    header("Location: /LibraryManagement/index.php");
}

date_default_timezone_set("Asia/Kolkata");


$membership=$_POST["membertype"];
$doi_to=$_POST["to"];
$doi_from=$_POST["from"];


function show_table($stat)
{
    include "dbconnect.php";
    $result=$conn->query($stat);
    if($result)
    {
        echo "<table>
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
        </table>";
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