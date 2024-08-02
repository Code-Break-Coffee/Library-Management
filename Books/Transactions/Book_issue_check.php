<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
include "../../connection/dbconnect.php";

if(!verification() || $_POST["Access"]!="Main-Issue-Check")
{
    header("Location: /LibraryManagement");
}
else
{
    if(!empty($_POST["memberid"]))
    {
        $mi=$_POST["memberid"];
        $mi = strtoupper($mi);
        $mi = str_replace("-","",$mi);
        $sql="SELECT Book_No,Author1,Author2,Author3,Title,Edition from books where Status='$mi';";
        $result=$conn->query($sql);
        if($result)
        {
            echo
            "
                <div style='width:100%;overflow:auto;height:650px;'>
                    <h6 style='color:aliceblue;background-color:black;width:100px;'><center>$mi</center></h6>
                    <table>
                        <tr>
                            <th>Book No</th>
                            <th>Title</th>
                            <th>Edition</th>
                            <th>Author 1</th>
                            <th>Author 2</th>
                            <th>Author 3</th>
                        </tr>
                        <tbody>";
                        while($row=$result->fetch_assoc())
                        {
                            echo
                            "
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
            echo
            "
                        </tbody>
                    </table>
                </div>
                <script>document.getElementById('issuefield').style.transform='translate(-100%,0%)';</script>
            ";
        }
        else
        {
            echo
            "
                <div title='Error❌' id='dialog1'>
                    <p>$conn->error</p>
                </div>
            ";
        }
    }
    else
    {
        header("Location: /LibraryManagement");
    }
}
?>