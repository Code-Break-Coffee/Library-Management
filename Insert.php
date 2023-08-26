<?php
@session_start();
include "dbconnect.php";
include "auth.php";
if(!verification())
{
    header("Location: /LibraryManagement/index.php");
}
else
{
    $sql;
    $bookno=$_POST["bookno"];
    $title=$_POST["title"];
    $edition=$_POST["edition"];
    $author1=$_POST["author1"];
    $author2;$author3;
    $publisher=$_POST["publisher"];
    $supplier;
    $cost;
    $total_pages=$_POST["totalpages"];
    $Cl_No=$_POST["CL"];
    $billno;
    if(!empty($_POST["author2"])) $author2=$_POST["author2"];
    else
    {
        $author2=null;
    }
    if(!empty($_POST["author3"])) $author3=$_POST["author3"];
    else
    {
        $author3=null;
    }
    if(!empty($_POST["author3"]) && empty($_POST["author2"]))
    {
        $author2=$_POST["author3"];
        $author3=null;
    }
    if(!empty($_POST["cost"])) $cost=$_POST["cost"];
    else $cost=null;
    if(!empty($_POST["billno"])) $billno=$_POST["billno"];
    else $billno=null;
    if(!empty($_POST["supplier"])) $supplier=$_POST["supplier"];
    else $supplier=null;

    $flag=0;
    $sqlcheck="SELECT Book_No from books where  Book_No='$bookno';";
    $resultcheck=$conn->query($sqlcheck);
    if($resultcheck)
    {
        while($row=$resultcheck->fetch_assoc())
        {
            if($bookno == $row["Book_No"])
            {
                $flag=1;
                echo "
                <div id='dialog3' style='color:red;' title='⚠️Error'>
                    <p><center>Book $bookno Already Present</center></p>
                </div>
                "; }
        }
    }
    else echo "
    <div id='dialog3' style='color:red;' title='⚠️Error'>
        <p><center>$conn->error</center></p>
    </div>
    "; 
    if($flag==0)
    {
        $sql="INSERT into books(Book_No,Author1,Author2,Author3,Title,Edition,Publisher,Cl_No,Total_Pages,Cost,Supplier,Bill_No) values
        ('$bookno','$author1','$author2','$author3','$title','$edition','$publisher',$Cl_No,$total_pages,$cost,'$supplier','$billno');";

        $result=$conn->query($sql);
        if($result)
        {
            echo "
            <div id='dialog3' style='color:green;' title='✅Successful'>
                <p><center>Book Inserted Successfully</center></p>
            </div>
            "; }
        else
        {
            echo "
            <div id='dialog3' style='color:red;' title='⚠️Error'>
                <p><center>$conn->error</center></p>
            </div>
            "; 
        }
    }
}
?>