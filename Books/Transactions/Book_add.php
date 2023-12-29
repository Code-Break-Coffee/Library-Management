<?php
@session_start();
include "dbconnect.php";
include "Auth\\auth.php";

function check($b, $count)
{
    include "dbconnect.php";
    for($i = 0; $i <= $count; $i++)
    {
        $sql = "SELECT Book_No from books WHERE Book_No = '$b';";
        $res = $conn->query($sql);
        $b += 1;
        if(mysqli_num_rows($res) != 0)return false;
    }
    return true;
}

function sugesstion_add($title,$author1,$author2,$author3,$publisher)
{
    include "dbconnect.php";

    $stat_title_check = "SELECT * FROM suggestion where  Book_value='$title' and category='Title';";
    $stat_publish_check = "SELECT * FROM suggestion where  Book_value='$publisher' and category='Publisher';";    
    

    $res_title = $conn->query($stat_title_check);
    $res_pulish = $conn->query($stat_publish_check);


    if(mysqli_num_rows($res_title)==0)
    {
        $stat_title = "INSERT INTO suggestion(Book_value,category) VALUES('$title','Title');";
        $res_append = $conn->query($stat_title);
    }
    if(mysqli_num_rows($res_pulish)==0)
    {
        $stat_publish = "INSERT INTO suggestion(Book_value,category) VALUES('$publisher','Publisher');";
        $res_append_publish = $conn->query($stat_publish);
    }

    $arr=array_unique(array($author1,$author2,$author3));
    foreach($arr as $i)
    {
        $stat_author_check = "SELECT * FROM suggestion where  Book_value='$i' and category='Author';";
        $res_auth = $conn->query($stat_author_check);
        if(mysqli_num_rows($res_auth)==0)
        {
            $stat_author = "INSERT INTO suggestion(Book_value,category) VALUES('$i','Author');";
            $res_append_author = $conn->query($stat_author);
        }
    }
}

if(!verification() || $_POST["Access"] != "Main-Insert")
{
    header("Location: /LibraryManagement/");
}
else
{
    $sql;
    $bookno = 0;
    if(!empty($_POST["bookno"])) $bookno=$_POST["bookno"]; //-----------------------------------(book number cast varcare-> num)
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
    $remark;
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
    if(!empty($_POST["remark"]))
    {
        $remark=$_POST["remark"];
    }
    else{
        $remark=null;
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
            $sql="INSERT into books(Book_No,Author1,Author2,Author3,Title,Edition,Publisher,Cl_No,Total_Pages,Cost,Supplier,Bill_No,Remark) values
            ('$bno','$author1','$author2','$author3','$title','$edition','$publisher',$Cl_No,$total_pages,$cost,'$supplier','$billno','$remark');";
            $result=$conn->query($sql);
            
            sugesstion_add($title,$author1,$author2,$author3,$publisher);
            
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