<?php
@session_start();
include "../../Auth/auth.php";
if(!verification() || $_POST["Access"]!="Main-Member-Books-Check")
{
    header("Location: /LibraryManagement/");
}
else
{
    if(!empty($_POST["mem_id"]))
    {
        include "../../connection/dbconnect.php";
        $memid=$_POST["mem_id"];
        $memid=strtoupper($memid);
        $memid=str_replace("-","",$memid);
        $sql="SELECT Book_No,Author1,Author2,Author3,Title,Edition from books where Status = '$memid';";
        $result=$conn->query($sql);
        if($result)
        {
            if(mysqli_num_rows($result)>0)
            {
                echo
                "
                    <div style='width:100%;overflow:auto;height:650px;'>
                        <h1 style='color:aliceblue;background-color: rgba(0, 0, 0, 0.2);backdrop-filter: blur(5px);width:200px;'><center>$memid</center></h1>
                        <table>
                            <tr>
                                <th>Book No</th>
                                <th>Author 1</th>
                                <th>Author 2</th>
                                <th>Author 3</th>
                                <th>Title</th>
                                <th>Edition</th>
                            </tr>
                            <tbody>
                ";
                while($row=$result->fetch_assoc())
                {
                            echo
                            "
                                <tr>
                                    <td>".$row["Book_No"]."</td>
                                    <td>".$row["Author1"]."</td>
                                    <td>".$row["Author2"]."</td>
                                    <td>".$row["Author3"]."</td>
                                    <td>".$row["Title"]."</td>
                                    <td>".$row["Edition"]."</td>
                                </tr>
                            ";
                }
                echo
                "
                            </tbody>
                        </table>
                    </div>
                    <script>
                        document.getElementById('member_books_check').style.transform='translate(-120%,-50%)';
                        document.getElementById('response_member_books_check').style.top='25%';
                        document.getElementById('response_member_books_check').style.left='45%';
                    </script>
                ";
            }
            else
            {
                echo
                "
                    <div style='color:green;' id='dialog_member_books_check' title='✅ Successful'>
                        <p><center>'$memid' has no books due with him/her!!!</center></p>
                    </div>
                ";
            }
        }
        else
        {
            echo
            "
                <div style='color:green;' id='dialog_member_books_check' title='❌ Error'>
                    <p><center>$conn->error</center></p>
                </div>
            ";
        }
    }
    else
    {
        echo "<script>window.open('./','_self');</script>";
    }
} 

?>