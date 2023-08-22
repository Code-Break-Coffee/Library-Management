<?php

date_default_timezone_set("Asia/Kolkata");
if(empty($_POST["bookno"]) && empty($_POST["author"]) && empty($_POST["title"]))
{
    header("Location: /LibraryManagement/index.php");
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
                $result->data_seek(0);
                return true;
            }
        }
        $result->data_seek(0);
        return false;
    }
    
    function Book_Author($bauthor)
    {
        include "dbconnect.php";
        $b ="%".strtolower($bauthor)."%";
        $sql = "SELECT * from books where Author1 LIKE '$b' or Author2 LIKE '$b' or Author3 LIKE '$b';";
        $result=$conn->query($sql);
        if($result)
        {
            echo "<table class='table table-responsive table-bordered table-dark table-striped'>
            <tr>
            <th>B No.</th>
            <th>Title</th>
            <th>Edition</th>
            <th>Author</th>
            <th>Author</th>
            <th>Author</th>
            </tr>";
            $count=0;
            while($row=$result->fetch_assoc())
            {
                $count++;
                // if($count>5) break;
                echo"
                <tr>
                <td>".$row["Book_No"]."</td>
                <td>".$row["Title"]."</td>
                <td>".$row["Edition"]."</td>
                <td>".$row["Author1"]."</td>
                <td>".$row["Author2"]."</td>
                <td>".$row["Author3"]."</td>
                </tr>
                ";
            }
            echo"</table>";
        }
        else echo $conn->error;
    }

    function Book_Name($bname)
    {
        include "dbconnect.php";
        $b ="%".strtolower($bname)."%";
        $sql = "SELECT * from books where Title LIKE '$b'";
        $result=$conn->query($sql);
        if($result)
        {
            echo "<table class='table table-responsive table-bordered table-dark table-striped'>
            <tr>
            <th>B No.</th>
            <th>Title</th>
            <th>Edition</th>
            <th>Author 1</th>
            <th>Author 2</th>
            <th>Author 3</th>
            </tr>";
            $count=0;
            while($row=$result->fetch_assoc())
            {
                $count++;
                // if($count>5) break;
                echo"
                <tr>
                <td>".$row["Book_No"]."</td>
                <td>".$row["Title"]."</td>
                <td>".$row["Edition"]."</td>
                <td>".$row["Author1"]."</td>
                <td>".$row["Author2"]."</td>
                <td>".$row["Author3"]."</td>
                </tr>
                ";
            }
            echo"</table>";
        }
        else echo $conn->error;
    }

    if(filter_input(INPUT_POST,"soption")=="Book No.")
    {
        include "dbconnect.php";
        $bno=$_POST["bookno"];
        $Search=Book_No($bno);
        $sql="SELECT Status from books where Book_No = $bno;";
        $result=$conn->query($sql);
        $f=0;
        if($result)
        {
            while($row=$result->fetch_assoc())
            {
                if($row["Status"] == "Available") $f=1;
            }
            if($f==1)
            {
                if($Search){}
                else echo "";
            }
            else
            {
                if($Search) echo "";
                else echo ""; 
            }
        }
        else echo $conn->error;
    }
    else if(filter_input(INPUT_POST,"soption")=="Title")
    {
        $bname=$_POST["title"];
        Book_Name($bname);
    }
    else if(filter_input(INPUT_POST,"soption")=="Author")
    {
        $bauthor=$_POST["author"];
        Book_Author($bauthor);
    }
}
?>