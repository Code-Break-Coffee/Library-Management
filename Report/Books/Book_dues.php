<?php
@session_start();
//include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
include "../../Auth/auth.php";
if($_POST["Access"]!="Main-Book-Dues" || !verification())
{
    header("Location: /LibraryManagement/");
}
else
{
    include "../../connection/dbconnect.php";
    $sql="SELECT * from books where Status!='Available';";
    $result=$conn->query($sql);
    if($result)
    {
        if(mysqli_num_rows($result)==0)
        {
            echo
            "
                <div title='⚠️Notification' id='dialog_book_dues' style='color:red;'>
                    <p>There are no Books Dues at the moment!!!</p>
                </div>
            ";
        }
        else
        {
            echo
            "
                <head>
                    <link rel='stylesheet' href='./Assets/DataTables/datatables.min.css'>
                    <link rel='stylesheet' href='./Assets/DataTables/datatables.css'>
                </head>
                <div style='position:absolute;top:70%;left:50%;height:600px;overflow:auto;transform:translate(-50%,-50%);'>
                <table id='example'>
                    <thead>
                        <tr>
                            <th class='row_head'>Book No.</th>
                            <th class='row_head'>Author 1</th>
                            <th class='row_head'>Author 2</th>
                            <th class='row_head'>Author 3</th>
                            <th class='row_head'>Title</th>
                            <th class='row_head'>Edition</th>
                            <th class='row_head'>Publisher</th>
                            <th class='row_head'>CL No.</th>
                            <th class='row_head'>Total Pages</th>
                            <th class='row_head'>Cost</th>
                            <th class='row_head'>Supplier</th>
                            <th class='row_head'>Remark</th>
                            <th class='row_head'>Bill_No</th>
                            <th class='row_head'>Status</th>
                        </tr>
                    </thead>
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
                            <td>".$row["Publisher"]."</td>
                            <td>".$row["Cl_No"]."</td>
                            <td>".$row["Total_Pages"]."</td>
                            <td>".$row["Cost"]."</td>
                            <td>".$row["Supplier"]."</td>
                            <td>".$row["Remark"]."</td>
                            <td>".$row["Bill_No"]."</td>
                            <td>".$row["Status"]."</td>
                        </tr>
                    ";
                }
            echo
            "
                    </tbody>
                </table>
                </div>
                <script src='./Assets/DataTables/datatables.js'></script>

                <script>
                    $(document).ready(function() {
                        $('#example').dataTable( {
                            jQueryUI: true
                        } );
                    } );
                </script> 
            ";
        }
    }
    else
    {
        echo
        "
            <div title='❌Error' id='dialog_book_dues' style='color:red;'>
                <p>$conn->error</p>
            </div>
        ";
    }
}
?>