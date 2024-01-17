<?php
session_start();
include "../../connection/dbconnect.php";

if(!empty($_POST["data"]))
{
    $sql;
    $data=$_POST["data"];

    $sql="SELECT DISTINCT Title,Edition,Author1,Author2,Author3,Publisher from books 
        where Author1 like '%$data%' or Author2 like '%$data%' or Author3 like '%$data%'
            or Title like '%$data%' or Publisher like '%$data%' and Status = 'Available';";
    $result=$conn->query($sql);
    if($result)
    {
        echo "
        <script>document.getElementById('clear2').style.display='block';</script>
        <table>
            <tr>
                <th>Title</th>
                <th>Edition</th>
                <th>Author 1</th>
                <th>Author 2</th>
                <th>Author 3</th>
                <th>Publisher</th>
            </tr>
                <tbody>";
            while($row=$result->fetch_assoc())
            {
                echo "
                    <tr>
                        <td>".$row["Title"]."</td>
                        <td>".$row["Edition"]."</td>
                        <td>".$row["Author1"]."</td>
                        <td>".$row["Author2"]."</td>
                        <td>".$row["Author3"]."</td>
                        <td>".$row["Publisher"]."</td>
                    </tr>";
            }
        echo "</tbody>
            </table>";
    }
    else echo $conn->error;
}
else echo $conn->error;
?>