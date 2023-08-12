<?php
include "dbconnect.php";

if(empty($_POST["bookno"]))
{
    echo "<script>window.alert('Input not Given aur Unauthorized Access!!!');</script>";
    include "index.php";
}
else
{
    $flag=0;
    $bookExist = false;
    $bookno=$_POST["bookno"];
    $bookcheck="SELECT Book_No from books where Book_No = '$bookno';";
    $sqlcheck="SELECT Issue_Bookno, Return_Date from issue_return where Issue_Bookno = '$bookno' and Return_Date is NULL;";
    $bookresultcheck= $conn->query($bookcheck);
    $resultcheck=$conn->query($sqlcheck);
    if($resultcheck && $bookresultcheck)
    {
        while($row=$bookresultcheck->fetch_assoc())
        {
            if($row["Book_No"] == $bookno)
            {
                $bookExist = true;
            }
        }
        while($row=$resultcheck->fetch_assoc())
        {
            if($row["Issue_Bookno"] == $bookno && $row["Return_Date"] != null)
            {
                $flag=1;
                echo "<div style='position:relative;top:50%;left:50%;transform:translate(-50%, -50%);color:red;'><div style='position:relative;left:575px;top:-150px;'><img src='close.png' width='20px' height='20px'/></div><center>Book $bookno is been issued by ".$row["Issue_By"]." so it cannot be deleted!!!</center></div>";
            }
        }
    }
    else echo $conn->error;
    if($flag==0 && $bookExist)
    {
        $sql="DELETE from books where Book_No = '$bookno';";
        $result=$conn->query($sql);
        if($result) echo "<div style='position:relative;top:50%;left:50%;transform:translate(-50%, -50%);color:green;'><div style='position:relative;left:575px;top:-150px;'><img src='close.png' width='20px' height='20px'/></div><center>Book $bookno deleted successfully!!!</center></div>";
        else echo $conn->error;
    }
    else if(!$bookExist)
    {
        echo "<div style='position:relative;top:50%;left:50%;transform:translate(-50%, -50%);color:red;'><div style='position:relative;left:575px;top:-150px;'><img src='close.png' width='20px' height='20px'/></div><center>$bookno does not exist in the database</center></div>";
    }
}
?>
