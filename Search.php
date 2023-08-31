<?php
@session_start();
include "auth.php";
if(!verification() || $_POST["Access"] != "Main-Search" )
{
    header("Location: /LibraryManagement/");
}
else
{
    date_default_timezone_set("Asia/Kolkata");
    function Book_No($bno)
    {
        include "dbconnect.php";
        $sql="SELECT * from books where Book_No = '$bno';";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result)>0)
        {
            while($row=$result->fetch_assoc())
            {
                if($row["Book_No"] == $bno)       
                {
                    $result->data_seek(0);
                    return true;
                }
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
        if($result && mysqli_num_rows($result) > 0)
        {
            echo "
            <div style='width:100%;overflow:auto;height:650px;'><table>
            <tr>
            <th>B No.</th>
            <th>Title</th>
            <th>Edition</th>
            <th>Author</th>
            <th>Author</th>
            <th>Author</th>
            </tr>
            <tbody>";
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
            echo"
            </tbody></table></div>
            <script>
                document.getElementById('SearchField').style.transform='translate(-120%,-50%)';
                document.getElementById('response5').style.transform='translate(50%,-90%)';
            </script>";
        }
        else if(mysqli_num_rows($result) <= 0)
        {
            echo "
                <div id='dialog' style='color:red;' title='⚠️Error' background: url(alert.png);>
                    <p><center>Book data not found</center></p>
                </div>";
        }
        else echo $conn->error;
    }

    function Book_Name($bname)
    {
        include "dbconnect.php";
        $b ="%".strtolower($bname)."%";
        $sql = "SELECT * from books where Title LIKE '$b'";
        $result=$conn->query($sql);
        if($result && mysqli_num_rows($result) > 0)
        {
            echo "
            <div style='width:100%;overflow:auto;height:650px;'><table>
            <tr>
            <th>B No.</th>
            <th>Title</th>
            <th>Edition</th>
            <th>Author 1</th>
            <th>Author 2</th>
            <th>Author 3</th>
            </tr>
            <tbody>";
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
            echo"</tbody></table></div>
                <script>
                    document.getElementById('SearchField').style.transform='translate(-120%,-50%)';
                    document.getElementById('response5').style.transform='translate(50%,-90%)';
                </script>";
        }
        else if(mysqli_num_rows($result) <= 0)
        {
            echo "
                <div id='dialog' style='color:red;' title='⚠️Error' background: url(alert.png);>
                    <p><center>Book data not found</center></p>
                </div>";
        }
        else echo $conn->error;
    }

    if(filter_input(INPUT_POST,"soption")=="Book No.")
    {
        include "dbconnect.php";
        $bno=$_POST["bookno"];
        $Search=Book_No($bno);
        $sql="SELECT Status from books where Book_No = '$bno';";
        $result=$conn->query($sql);
        $f=0;
        if($result && mysqli_num_rows($result)>0)
        {
            while($row=$result->fetch_assoc())
            {
                if($row["Status"] == "Available") $f=1;
            }
            if($f==1)
            {
                if($Search) echo"
                <div id='dialog' style='color:green;' title='Available ✅'>
                    <p><center>Book $bno is Available and can be Issued!!!</center></p>
                </div>";
                else echo "
                <div id='dialog' style='color:red;' title='Not Found 🤡'>
                    <p><center>Book $bno does not Exist</center></p>
                </div>";
            }
            else
            {
                if($Search) echo "
                <div id='dialog' style='color:red;' title='Not Available ❌'>
                    <p><center>Book $bno is been Issued already!!!</center></p>
                </div>";
                else echo "
                <div id='dialog' style='color:red;' title='Not Found ❌'>
                    <p><center>Book $bno does not Exist</center></p>
                </div>"; 
            }
        }
        else if(!$result) echo "
        <div id='dialog' style='color:red;' title='Error ❌'>
            <p><center>$conn->error</center></p>
        </div>";
        else
        {
            echo "
            <div id='dialog' style='color:red;' title='Not Found ❌'>
                <p><center>Book $bno does not Exist</center></p>
            </div>";
        }
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