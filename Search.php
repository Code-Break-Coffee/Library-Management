<?php

date_default_timezone_set("Asia/Kolkata");
// $Search = array();

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
    $b ="%".strtolower($bname)."%";
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


if(filter_input(INPUT_POST,"soption")=="BookNo")
{
    $bno=$_POST["Required"];
    $Search = Book_No($bno);
}
elseif(filter_input(INPUT_POST,"soption")=="BookName")
{
    $bname=$_POST["Required"];
    $Search = Book_Name($bname);
}
elseif(filter_input(INPUT_POST,"soption")=="BookAuthor")
{
    $bauthor=$_POST["Required"];
    $Search = Book_Autor($bauthor);
}


$sql_b="SELECT * from books;";
?>
