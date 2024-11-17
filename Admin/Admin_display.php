<?php
@session_start();
include "../Auth/auth.php";
// include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
if(empty($_POST["level"]) || !verification(1) || $_POST["Access"]!="Main-Admin_display")
header("Location: /LibraryManagement");
else
{
    $level=$_POST["level"];
    show_table($level);
}
function show_table($l)
{
    include "../connection/dbconnect.php";
    $stat="SELECT * FROM admin where User_level = '$l';";
    $result=$conn->query($stat);
    if($result)
    {
        echo "
        <head>
            <link rel='stylesheet' href='./Assets/DataTables/datatables.min.css'>
            <link rel='stylesheet' href='./Assets/DataTables/datatables.css'>
        </head>
        <div id='display_table' style='width:100%;height:650px;overflow:auto;'>
        <table id='example'>
            <button class='btn new_css_btn' onclick='closeTable()'>x</button>
        <thead>
        <tr>
            <th>User ID</th>
            <th>User Level</th>
        </tr>
        </thead>
        <tbody>";
        
        while($row=$result->fetch_assoc())
        {
            echo"
            <tr>
            <td>".$row["Username"]."</td>
            <td>".$row["User_level"]."</td>
            </tr>";
        }
        echo "
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
        <script>
            document.getElementById('display').style.display='none';
            function closeTable()
            {
                document.getElementById('display_table').style.display='none';
                document.getElementById('display').style.display='flex';
                document.getElementById('display').style.alignItems='center';
                document.getElementById('display').style.justifyContent='center';
            }
        </script>";
    }
    else
    {
        echo "
        <div id='dialog_admin_disp' style='color:red;' title='⚠️Error'>
            <p><center>$conn->error</center></p>
        </div>
        "; 
    }
}
?>