<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
include "../../connection/dbconnect.php";
if(!verification() || $_POST["Access"]!="Main-Book-Filter")
{
    header("Location: /LibraryManagement/");
}
else
{
    $sql="SELECT * from books WHERE ";
    $bool=false;

    if(!empty($_POST["title"]))
    {
        $title=$_POST["title"];
        $sql=$sql."Title like '%$title%' ";
        $bool=true;
    }
    if(!empty($_POST["author"]))
    {
        $author=$_POST["author"];
        if($bool)
        {
            $sql=$sql."and ";
        }
        $bool=true;
        $sql=$sql."(Author1 like '%$author%' or Author2 like '%$author%' or Author3 like '%$author%') ";
    }
    if(!empty($_POST["publisher"]))
    {
        $publisher=$_POST["publisher"];
        if($bool)
        {
            $sql=$sql."and ";
        }
        $bool=true;
        $sql=$sql."Publisher like '%$publisher%' ";
    }
    if(!empty($_POST["supplier"]))
    {
        $supplier=$_POST["supplier"];
        if($bool)
        {
            $sql=$sql."and ";
        }
        $bool=true;
        $sql=$sql."Supplier like '%$supplier%' ";
    }
    if(empty($_POST["title"]) && empty($_POST["author"]) && empty($_POST["publisher"]) && empty($_POST["supplier"]))
    {
        $sql="SELECT * from books;";
    }
    
    $result=$conn->query($sql);
    if($result)
    {
        echo
        "
            <div style='overflow:auto;width:100%;height:587px;'>
            <center>
                <table style='width:95%;'>
                    <tr>
                        <th>Book No.</th>
                        <th>Title</th>
                        <th>Author 1</th>
                        <th>Author 2</th>
                        <th>Author 3</th>
                        <th>Edition</th>
                        <th>Publisher</th>
                        <th>CL No.</th>
                        <th>Total Pages</th>
                        <th>Cost</th>
                        <th>Supplier</th>
                        <th>Bill No.</th>
                        <th>Remark</th>
                        <th>Status</th>
                    </tr>
                    <tbody>
        ";
            while($row=$result->fetch_assoc())
            {
                echo
                "
                    <tr>
                        <td>".$row["Book_No"]."</td>
                        <td>".$row["Title"]."</td>
                        <td>".$row["Author1"]."</td>
                        <td>".$row["Author2"]."</td>
                        <td>".$row["Author3"]."</td>
                        <td>".$row["Edition"]."</td>
                        <td>".$row["Publisher"]."</td>
                        <td>".$row["Cl_No"]."</td>
                        <td>".$row["Total_Pages"]."</td>
                        <td>".$row["Cost"]."</td>
                        <td>".$row["Supplier"]."</td>
                        <td>".$row["Bill_No"]."</td>
                        <td>".$row["Remark"]."</td>
                        <td>".$row["Status"]."</td>
                    </tr>
                ";
            }
        echo
        "
                    </tbody>
                </table>
            </center>
            </div>
        ";
    }
}
?>