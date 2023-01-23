<?php
    include "dbconnect.php";
    
    $bn;$a;$t;$e;$p;$pa;$c;$s;$b;
    if(datacheck())
    {
        $bn=$_POST["bookno"];
        $a=$_POST["author"];
        $t=$_POST["title"];
        $e=$_POST["edition"];
        $p=$_POST["publisher"];
        $pa=$_POST["pages"];
        $c=$_POST["cost"];
        $s=$_POST["supplier"];
        $b=$_POST["bill"];

        $sql="INSERT INTO books(Book_No,Authors,Title,Edition,Publisher,
        Total_Pages,Cost,Name_of_supplier,Bill_No) values('$bn','$a','$t','$e','$p',$pa,$c,'$s','$b');";
        $result=$conn->query($sql);
        if($result)
        {
            echo"Book Successfully Inserted!!!";
        }
        else
        {
            echo"$conn->error";
        }
    }
    function datacheck()
    {
        if(strlen($_POST["bookno"]) > 10)
        {
            echo"Book No. should not exceed 10 characters!!!";
            return false;
        }
        if(strlen($_POST["author"]) > 50)
        {
            echo"Author Name should not exceed 50 characters!!!";
            return false;
        }
        if(strlen($_POST["title"]) > 30)
        {
            echo"Title should not exceed 30 characters!!!";
            return false;
        }
        if(strlen($_POST["edition"]) > 15)
        {
            echo"Edition should not exceed 15 characters!!!";
            return false;
        }
        if(strlen($_POST["publisher"]) > 50)
        {
            echo"Publisher Name should not exceed 50 characters!!!";
            return false;
        }
        if(strlen(strval($_POST["pages"])) > 11)
        {
            echo"Total Pages should not exceed 11 characters!!!";
            return false;
        }
        if(strlen(strval($_POST["cost"])) > 11)
        {
            echo"Cost should not exceed 11 characters!!!";
            return false;
        }
        if(strlen($_POST["supplier"]) > 50)
        {
            echo"Supplier Name should not exceed 50 characters!!!";
            return false;
        }
        if(strlen($_POST["bill"]) > 20)
        {
            echo"Bill No. should not exceed 20 characters!!!";
            return false;
        }
        return true;
    }
?>