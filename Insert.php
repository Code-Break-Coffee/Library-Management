<?php
@session_start();
include "dbconnect.php";
include "auth.php";

function check($b, $count)
{
    include "dbconnect.php";
    $Copy = false;
    for($i = 0; $i <= $count; $i++)
    {
        $b += 1;
        $sql = "SELECT Book_No from books WHERE Book_No = '$b';";
        $res = $conn->query($sql);
        if(mysqli_num_rows($res) != 0)$Copy = true;
    }
    if($Copy)return false;
    else return true;
}
if(!verification() || $_POST["Access"] != "Main-Insert")
{
    header("Location: /LibraryManagement/");
}
else
{
    $sql;
    $bookno = 0;
    if(!empty($_POST["bookno"])) $bookno=$_POST["bookno"];
    else
    {
        $sql_max_book = "SELECT Book_No from books;";
        $res=$conn->query($sql_max_book);
        if(!$res)echo "
        <div id='dialog3' style='color:red;' title='⚠️Error'>
            <p><center>$conn->error</center></p>
        </div>
        "; 
        while($row =$res->fetch_assoc())
        {
            if((int)preg_replace("/[^0-9]/","",$row["Book_No"]) > $bookno) $bookno = (int)preg_replace("/[^0-9]/","",$row["Book_No"]);
        }
        $bookno += 1;
    }
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
    $bookcount = 1;
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
    if(!empty($_POST["bookcount"])) $bookcount=$_POST["bookcount"];
    else $bookcount=1;  

    $flag=0;
    $sqlcheck="SELECT Book_No from books where Book_No='$bookno';";
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
    if(!check($bookno,$bookcount) && $flag == 0)
    {
        echo "
                <div id='dialog3' style='color:red;' title='⚠️Error'>
                    <p><center>Book Already Present in the given range</center></p>
                </div>
                "; 
        $flag = 1;
    }
    if($flag==0)
    {
        $flagcount=0;
        for($i=0;$i<$bookcount;$i++)
        {
            $bno = $bookno + $i;
            $sql="INSERT into books(Book_No,Author1,Author2,Author3,Title,Edition,Publisher,Cl_No,Total_Pages,Cost,Supplier,Bill_No) values
            ('$bno','$author1','$author2','$author3','$title','$edition','$publisher',$Cl_No,$total_pages,$cost,'$supplier','$billno');";
            $result=$conn->query($sql);
            if($result) $flagcount++;
            else echo $conn->error;
        }

        if($flagcount==$bookcount)
        {
            echo "
            <div id='dialog3' style='color:green;' title='✅Successful'>
                <p><center>$bookcount Books Inserted Successfully</center></p>
            </div>
            "; 
        }
        else
        {
            echo "
            <div id='dialog3' style='color:red;' title='⚠️Error'>
                <p><center>Some Error Occured</center></p>
            </div>
            "; 
        }
    }
}
?>