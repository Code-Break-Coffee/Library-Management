<?php
session_start();
include "../../connection/dbconnect.php";

if(!empty($_POST["data"]))
{
    $sql="SELECT Title, Edition, Author1,Author2,Author3,Publisher, Status from books where ";
    $data=$_POST["data"];
    $data_arr=explode(" ",$data);
    for($i=0;$i<sizeof($data_arr);$i++)
    {
        if($i == sizeof($data_arr) - 1)
        {
            $sql=$sql."Author1 like '%$data_arr[$i]%'
            or Title like '%$data_arr[$i]%' or Author2
            like '%$data_arr[$i]%' or Author3 like '%$data_arr[$i]%'
            or Edition like '%$data_arr[$i]%'
            or Publisher like '%$data_arr[$i]%';";
        }
        else
        {
            $sql=$sql."Author1 like '%$data_arr[$i]%'
            or Title like '%$data_arr[$i]%' or Author2
            like '%$data_arr[$i]%' or Author3 like '%$data_arr[$i]%'
            or Edition like '%$data_arr[$i]%'
            or Publisher like '%$data_arr[$i]%' or ";
        }
    }
    $result=$conn->query($sql);
    if($result)
    {
        echo "
            <script>document.getElementById('clear2').style.display='block';</script>
            <script>document.getElementById('formblock').style.display='none';</script>
            <table class='table table-responsive table-bordered bg-dark' style='width:100%;'>
                <tr class='thead'>
                    <th colspan='1'>
                        <center>
                            <input type='button' class='btn col-6' onclick='cleared();' id='clear2' value='x'>
                        </center>
                    </th>
                    <th colspan='4'>
                        <h1 style='text-align:center;'>
                            Books
                        </h1>
                    </th>
                </tr>
                <tr class='thead'>
                    <th>Title</th>
                    <th>Edition</th>
                    <th>Authors</th>
                    <th>Publisher</th>
                    <th>Status</th>
                </tr>
                <tbody>";
        while($row=$result->fetch_assoc())
        {
            echo "
                <tr class='tbody'>
                    <td>".$row["Title"]."</td>
                    <td>".$row["Edition"]."</td>
                    <td>".$row["Author1"].", ".$row["Author2"].", ".$row["Author3"]."</td>
                    <td>".$row["Publisher"]."</td>
                    ";
                    if($row["Status"]!="Available")
                    {
                        echo "<td>Issued By Someone</td>";
                    }
                    else
                    {
                        echo"
                        <td>".$row["Status"]."</td>";
                    }
                    echo "</tr>";
        }
        echo "
        </tbody></table>
        ";
    }
    else
    {
        echo "<script>alert('Some error Occurred!!!');</script>";
        echo "<script>window.location.reload();</script>";
    }


    // $sql="SELECT Title,Edition,Author1,Author2,Author3,Publisher,Status from books 
    //     where Author1 like '%$data%' or Author2 like '%$data%' or Author3 like '%$data%'
    //         or Title like '%$data%' or Publisher like '%$data%';";
    // $result=$conn->query($sql);
    // if($result)
    // {
    //     echo "
    //     <script>document.getElementById('clear2').style.display='block';</script>
    //     <table>
    //         <tr>
    //             <th>Title</th>
    //             <th>Edition</th>
    //             <th>Author 1</th>
    //             <th>Author 2</th>
    //             <th>Author 3</th>
    //             <th>Publisher</th>
    //         </tr>
    //             <tbody>";
    //         while($row=$result->fetch_assoc())
    //         {
                // echo "
                //     <tr>
                //         <td>".$row["Title"]."</td>
                //         <td>".$row["Edition"]."</td>
                //         <td>".$row["Author1"]."</td>
                //         <td>".$row["Author2"]."</td>
                //         <td>".$row["Author3"]."</td>
                //         <td>".$row["Publisher"]."</td>
                //     </tr>";
    //         }
    //     echo "</tbody>
    //         </table>";
    // }
    // else echo $conn->error;
}
else header("Location: /LibraryManagement/StudentPage/student.html");
?>