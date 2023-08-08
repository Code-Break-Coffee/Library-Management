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
                echo "Book $bookno is been issued by ".$row["Issue_By"]." so it cannot be deleted!!!";
            }
        }
    }
    else echo $conn->error;
    if($flag==0 && $bookExist)
    {
        $sql="DELETE from books where Book_No = '$bookno';";
        $result=$conn->query($sql);
        if($result) echo "Book $bookno deleted successfully!!!";
        else echo $conn->error;
    }
    elseif(!$bookExist)
    {
        echo "$bookno doesnot exist in the database";
    }
}
?>
