<?php

date_default_timezone_set("Asia/Kolkata");


$membership=$_POST["membertype"];
$doi_to=$_POST["to"];
$doi_from=$_POST["from"];




function show_table($stat){
    include "dbconnect.php";
    $result=$conn->query($stat);
    if($result){
        echo "<table class='table table-responsive table-bordered table-dark table-striped'>
        <tr>
        <th>Issue_Bookno</th>
        <th>Issue_By</th>
        <th>Issue_Date</th>
        <th>Return_Date</th>
        </tr>";
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
    }
    else{
        echo $conn->error;
    }
    
}

if($membership=="Student"){
    $sql_mem="SELECT Issue_Bookno,Issue_By,Issue_Date,Return_Date FROM issue_return where Member_Type='Student' and Issue_Date>=$doi_from and Return_Date<=$doi_to;";
    show_table($sql_mem);
}
else if($membership=="Faculty"){
    $sql_mem="SELECT Issue_Bookno,Issue_By,Issue_Date,Return_Date FROM issue_return where Member_Type='Faculty' and Issue_Date>=$doi_from and Return_Date<=$doi_to;";
    show_table($sql_mem);
}
else{
    $sql_mem="SELECT Issue_Bookno,Issue_By,Issue_Date,Return_Date FROM issue_return where Issue_Date>=$doi_from and Return_Date<=$doi_to;";
    show_table($sql_mem);
}



// echo "
// <div id='dialog7' style='color:green;' title='Success'>
//     <p><center>Done</center></p>
// </div>
// "; 
?>