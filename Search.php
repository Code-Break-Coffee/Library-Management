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

    function displayTable($result, $conn)
    {
        if($result && mysqli_num_rows($result) > 0)
        {
            $Book_Copies=[];
            $Book_No=[];
            $Book_Author=[];
            $Book_Publisher=[];
            $Book_Available=[];
            $Edition=[
                1 => 'st',
                2 => 'nd',
                3 => 'rd'
            ];

            while($row=$result->fetch_assoc())
            {
                $e ="";
                if($row["Edition"] >= 4) $e = "th";
                elseif($row["Edition"] <= 3 && $row["Edition"] >=1) $e = $Edition[$row["Edition"]];
                $row["Title"] = $row["Title"]." ".$row["Edition"].$e;

                if(array_key_exists($row["Title"],$Book_Copies)) $Book_Copies[$row["Title"]] = (int)$Book_Copies[$row["Title"]] +1;
                else $Book_Copies[$row["Title"]] = (int)1;

                if(array_key_exists($row["Title"],$Book_No)) $Book_No[$row["Title"]] = $Book_No[$row["Title"]].", ".$row["Book_No"];
                else $Book_No[$row["Title"]] = $row["Book_No"];

                if(!array_key_exists($row["Title"],$Book_Author)) $Book_Author[$row["Title"]] = $row["Author1"].", ".$row["Author2"].", ".$row["Author3"];
                    
                if(!array_key_exists($row["Title"],$Book_Publisher)) $Book_Publisher[$row["Title"]] = $row["Publisher"];

                $b = $row["Book_No"];
                $sql_Av = "Select Status from books where Book_No = '$b'; ";
                $result_Av = $conn->query($sql_Av);
                $book_status = "";
                while($r=$result_Av->fetch_assoc()) $book_status = $r["Status"];

                if(array_key_exists($row["Title"],$Book_Available))
                {
                    if($book_status == "Available")
                    {
                        $Book_Available[$row["Title"]] = (int)$Book_Available[$row["Title"]] + 1;
                    }
                }
                else
                {
                    $Book_Available[$row["Title"]] = 0;
                    if($book_status == "Available")
                    {
                        $Book_Available[$row["Title"]] = (int)$Book_Available[$row["Title"]] + 1;
                    }
                }
            }
            echo "
                <div style='width:100%;overflow:auto;height:650px;'><table>
                <tr>
                <th>B No.</th>
                <th>Title</th>
                <th>Author's</th>
                <th>Publisher</th>
                <th>No of Copies</th>
                <th>Available</th>
                </tr>
                <tbody>";

            ksort($Book_No);
            foreach($Book_No as $bTitle=>$bno)
            {
                echo"
                <tr>
                <td>".$bno."</td>
                <td>".$bTitle."</td>
                <td>".$Book_Author["$bTitle"]."</td>
                <td>".$Book_Publisher["$bTitle"]."</td>
                <td>".$Book_Copies["$bTitle"]."</td>
                <td>".$Book_Available["$bTitle"]."</td>
                <td></td>
                <td></td>
                </tr>
                ";
            }

            echo"
                </tbody></table></div>
                <script>
                    document.getElementById('SearchField').style.transform='translate(-120%,-50%)';
                    document.getElementById('response5').style.top='25%';
                    document.getElementById('response5').style.left='45%';
                </script>";

        }
        else if(mysqli_num_rows($result) == 0)
        {
            echo "
                <div id='dialog' style='color:red;' title='⚠️Error' background: url(alert.png);>
                    <p><center>Book data not found</center></p>
                </div>";
        }
        else echo $conn->error;
    }

    function Search($bVal, $Course)
    {
        include "dbconnect.php";
        $b = "%".strtolower($bVal)."%";
        $sql = "";
        if($Course == "filter"){
            $sql = "SELECT Title,Edition,Book_No,Author1,Author2,Author3,Publisher from books where Author1 like '$b' or Author2 like '$b' or Author3 like '$b'
            or Title like '$b' or Publisher like '$b' ORDER BY Book_No;";
        }
        else{
            $sql = "SELECT Title,Edition,Book_No,Author1,Author2,Author3,Publisher from books where (Author1 like '$b' or Author2 like '$b' or Author3 like '$b'
            or Title like '$b' or Publisher like '$b') and Cl_No IN(SELECT CL_No from course_cl where Course = '$Course') ORDER BY Book_No;";
        }
        $result=$conn->query($sql);
        displayTable($result, $conn);
    }
    
    function Book_Author($bauthor, $Course)
    {
        include "dbconnect.php";
        $b ="%".strtolower($bauthor)."%";
        $sql ="";
        if($Course != "filter")
        {
            $sql = "SELECT * from books where (Author1 LIKE '$b' or Author2 LIKE '$b' or Author3 LIKE '$b') and Cl_No in (SELECT CL_No  from course_cl where Course ='$Course');";
        }
        else
        {
            $sql = "SELECT * from books where Author1 LIKE '$b' or Author2 LIKE '$b' or Author3 LIKE '$b';";
        }
        $result=$conn->query($sql);
        displayTable($result, $conn);
    }

    function Book_Name($bname, $Course)
    {
        include "dbconnect.php";
        $b ="%".strtolower($bname)."%";
        $sql ="";
        if($Course != "filter")
        {
            $sql = "SELECT * from books where Title LIKE '$b' and Cl_No in (SELECT CL_No  from course_cl where Course ='$Course');";
        }
        else
        {
            $sql = "SELECT * from books where Title LIKE '$b';";
        }
        $result=$conn->query($sql);
        displayTable($result, $conn);
    }

    if(filter_input(INPUT_POST,"soption")=="search")
    {
        $Category= filter_input(INPUT_POST,"foption");
        $book = $_POST["book"];
        Search($book, $Category);
    }
    else if(filter_input(INPUT_POST,"soption")=="Book No.")
    {
        include "dbconnect.php";
        $bno=$_POST["bookno"];
        $Search=Book_No($bno);
        $sql="SELECT Status from books where Book_No = '$bno';";
        $result=$conn->query($sql);
        $f=0;
        // $bookno = 0;

        //     $sql_max_book = "SELECT MAX(Book_No)as bno_max from books;";
        //     $res=$conn->query($sql_max_book);
        //     while($row =$res->fetch_assoc())
        //     {
        //         $bookno = (int)$row["bno_max"] ;
        //     }

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
        $Category= filter_input(INPUT_POST,"foption");
        Book_Name($bname, $Category);
    }
    else if(filter_input(INPUT_POST,"soption")=="Author")
    {
        $bauthor=$_POST["author"];
        $Category= filter_input(INPUT_POST,"foption");
        Book_Author($bauthor, $Category);
    }
}
