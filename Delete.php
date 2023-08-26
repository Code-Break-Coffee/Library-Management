<?php
include "dbconnect.php";

if(empty($_POST["bookno"]))
{
    header("Location: /LibraryManagement/index.php");
}
else
{
    $flag=0;
    $bookExist = false;
    $bookno=$_POST["bookno"];
    $bookcheck="SELECT Book_No from books where Book_No = $bookno;";
    $sqlcheck="SELECT Issue_Bookno, Return_Date,Issue_By from issue_return where Issue_Bookno = $bookno;";
    $bookresultcheck= $conn->query($bookcheck);
    $resultcheck=$conn->query($sqlcheck);
    if($resultcheck && $bookresultcheck)
    {
        if(mysqli_num_rows($bookresultcheck)==1) $bookExist=true;
        if($bookExist)
        {
            while($row=$resultcheck->fetch_assoc())
            {
                if($row["Issue_Bookno"] == $bookno && $row["Return_Date"] == null)
                {
                    $flag=1;
                    echo "
                    <div id='dialog4' style='color:red;' title='Notification ❌'>
                        <p><center>Book $bookno is been issued by ".$row["Issue_By"]." so it cannot be deleted!!!</center></p>
                    </div>
                    "; 
                }
            }
        }
    }
    else echo $conn->error;
    if($flag==0 && $bookExist)
    {
        $sql="DELETE from books where Book_No = '$bookno';";
        $result=$conn->query($sql);
        if($result)        echo "
        <div id='dialog4' style='color:green;' title='Notification ✅'>
            <p>Book $bookno Deleted Succesfully</p>
        </div>
        "; 
        else echo $conn->error;
    }
    else if(!$bookExist)
    {
        echo "
        <div id='dialog4' style='color:red;' title='Notification ❌'>
            <p>Book $bookno does not Exist</p>
        </div>
        "; 
    }
}
?>
