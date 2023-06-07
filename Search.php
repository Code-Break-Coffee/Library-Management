<?php

date_default_timezone_set("Asia/Kolkata");
if(empty($_POST["bookno"]) && empty($_POST["author"]) && empty($_POST["title"]))
{
    echo "<script>window.alert('Unauthorized Access or Inputs Not Given!!!');</script>";
    include "index.html";
}
else
{
    function Book_No($bno)
    {
        include "dbconnect.php";
        $sql="SELECT * from books;";
        $result = $conn->query($sql);
        while($row=$result->fetch_assoc())
        {
            if($row["Book_No"] == $bno)
            {
                return true;
            }
        }
        return false;
    }

    function Book_Autor($bauthor)
    {
        include "dbconnect.php";
        $books = array();
        $b ="%".strtolower($bauthor)."%";
        $sql = "SELECT Book_No from books where Author LIKE '$b'";
        $result=$conn->query($sql);
        while($row = $result->fetch_assoc()) $books[] = $row;
        return $books;
    }

    function Book_Name($bname)
    {
        include "dbconnect.php";
        $books = array();
        $b ="%".strtolower($bname)."%";
        $sql = "SELECT Book_No from books where Title LIKE '$b'";
        $result=$conn->query($sql);
        while($row = $result->fetch_assoc()) $books[] = $row;
        return $books;
    }


    if(filter_input(INPUT_POST,"soption")=="Book No.")
    {
        $bno=$_POST["bookno"];
        $Search = Book_No($bno);
        $s="SELECT Status from books where Book_No = $bno;";
        $r=$conn->query($s);
        $f=0;
        while($row=$r->fetchassoc())
        {
            if($row["Status"] == "Available") $f=1;
        }
        if($f==1)
        {
            if($Search) echo "Book $bno is Available in the Library and can be issued!!!"; 
            else echo "Book Not Available in the Library!!!";
        }
        else
        {
            if($Search) echo "Book $bno is Available in the Library but is currently issued by another member!!!";
            else echo "Book Not Available in the Library!!!"; 
        }
    }
    else if(filter_input(INPUT_POST,"soption")=="Title")
    {
        $bname=$_POST["title"];
        $Search = Book_Name($bname);
    }
    else if(filter_input(INPUT_POST,"soption")=="Author")
    {
        $bauthor=$_POST["author"];
        $Search = Book_Autor($bauthor);
    }


    $sql_b="SELECT * from books;";
    }
?>
