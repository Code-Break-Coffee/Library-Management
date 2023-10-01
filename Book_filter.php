<?php
@session_start();
include "auth.php";
include "dbconnect.php";
if(!verification() || $_POST["Access"]!="Main-Book-Filter")
{
    header("Location: /LibraryManagement/");
}
else
{
    //-------------------------------------------------karna he abhi aadha he
    $title=$_POST["title"];
    $author=$_POST["author"];
    $publisher=$_POST["publisher"];
    $supplier=$_POST["supplier"];

    $sql="SELECT * from books where
    Author1 like '%$author%' and 
    Title like '%$title%' and
    Publisher like '%$publisher%' and
    Supplier like '%$publisher%';";

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