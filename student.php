<?php
session_start();
include "dbconnect.php";
if(empty($_SESSION["search"]) || empty($_SESSION["data"]))
{
    if(empty($_POST["search"]) || empty($_POST["data"]))
    {
        header("Location: /LibraryManagement/student.html");
    }
    else
    {
        $_SESSION["search"]=$_POST["search"];
        $_SESSION["data"]=$_POST["data"];
    }
}
else if(!empty($_SESSION["search"]) && !empty($_SESSION["data"]))
{
    $sql;
    $data=$_POST["data"];
    if($_POST["search"]=="Author")
    {
        $sql="SELECT Title,Edition,Author1,Author2,Author3 from books 
        where Author1 like '%$data%' or Author2 like '%$data%' or Author3 like '%$data%';";
    }
    else if($_POST["search"] == "Title")
    {
        $sql="SELECT Title,Edition,Author1,Author2,Author3 from books 
        where Title like '%$data%';";
    }
    else header("Location: /LibraryManagement/student.html");
    $result=$conn->query($sql);
    if($result)
    {
        echo "
        <script>document.getElementById('clear2').style.display='block';</script>
        <table class='table table-responsive table-dark table-striped table-bordered'>
            <tr>
                <th>Title</th>
                <th>Edition</th>
                <th>Author 1</th>
                <th>Author 2</th>
                <th>Author 3</th>
            </tr>";
            while($row=$result->fetch_assoc())
            {
                echo "
                    <tr>
                        <td>".$row["Title"]."</td>
                        <td>".$row["Edition"]."</td>
                        <td>".$row["Author1"]."</td>
                        <td>".$row["Author2"]."</td>
                        <td>".$row["Author3"]."</td>
                    </tr>";
            }
        echo "</table>";
    }
    else echo $conn->error;
}
else echo $conn->error;
?>