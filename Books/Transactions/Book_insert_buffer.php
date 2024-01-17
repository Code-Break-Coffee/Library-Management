<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/LibraryManagement/Auth/auth.php";
include "dbconnect.php";//-------------------------------------------------------------------------------------------------------------------------------------

if (!verification() || $_POST["Access"] != "Book_add_excel-insert_buffer") {
    header("Location: /LibraryManagement/");
}

function sugesstion_add($title,$author1,$author2,$author3,$publisher)
{
    include "dbconnect.php";//-----------------------------------------------------------------------------------------------------------------------------------

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

$sql = "SELECT * FROM insert buffer";
$result = $conn->query($sql);


if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
    $sql_book;
    $bookno = 0;
    $bookno=$row["val14"]; //-----------------------------------(book number cast varcare-> num)
    $title=$row["title"];
    $edition=$row["edition"];
    $author1=$row["author1"];
    $author2;$author3;
    $publisher=$row["publisher"];
    $supplier;
    $cost;
    $total_pages=$row["totalpages"];
    $Cl_No=$row["CL"];
    $billno;
    $bookcount = 1;
    $remark;
    if(!empty($row["author2"])) $author2=$row["author2"];
    else
    {
        $author2=null;
    }
    if(!empty($row["author3"])) $author3=$row["author3"];
    else
    {
        $author3=null;
    }
    if(!empty($row["author3"]) && empty($row["author2"]))
    {
        $author2=$row["author3"];
        $author3=null;
    }
    if(!empty($row["remark"]))
    {
        $remark=$row["remark"];
    }
    else{
        $remark=null;
    }
    if(!empty($row["cost"])) $cost=$row["cost"];
    else $cost=null;
    if(!empty($row["billno"])) $billno=$row["billno"];
    else $billno=null;
    if(!empty($row["supplier"])) $supplier=$row["supplier"];
    else $supplier=null;
    if(!empty($row["bookcount"])) $bookcount=$row["bookcount"];
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
            $sql_book="INSERT into books(Book_No,Author1,Author2,Author3,Title,Edition,Publisher,Cl_No,Total_Pages,Cost,Supplier,Bill_No,Remark) values
            ('$bno','$author1','$author2','$author3','$title','$edition','$publisher',$Cl_No,$total_pages,$cost,'$supplier','$billno','$remark');";
            $result=$conn->query($sql_book);
            
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
}
$result->data_seek(0);
