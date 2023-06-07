<?php
include "dbconnect.php";

if(empty($_POST["bookno"]))
{
    echo "<script>window.alert('Input not Given aur Unauthorized Access!!!');</script>";
    include "index.html";
}
else
{
    $flag=0;
    $bookno=$_POST["bookno"];
    $sqlcheck="SELECT * from issue_return;";
    $resultcheck=$conn->query($sqlcheck);
    if($resultcheck)
    {
        while($row=$resultcheck->fetch_assoc())
        {
            if($row["Issue_Bookno"] == $bookno)
            {
                $flag=1;
                echo "Book $bookno is been issued by ".$row["Issue_By"]." so it cannot be deleted!!!";
            }
        }
    }
    else echo $conn->error;
    if($flag==0)
    {
        $sql="DELETE from books where Book_No = '$bookno';";
        $result=$conn->query($sql);
        if($result) echo "Book $bookno deleted successfully!!!";
        else echo $conn->error;
    }
}
?>
