<?php
@session_start();
//include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
include "../../Auth/auth.php";
if(!verification() || $_POST["Access"] != "Main-Audit" )
{
    header("Location: /LibraryManagement/");
}

date_default_timezone_set("Asia/Kolkata");


$membership=$_POST["membertype"];
$doi_to=$_POST["to"];
$doi_from=$_POST["from"]; 


function show_table($stat)
{
    include "../../connection/dbconnect.php";
    $result=$conn->query($stat);
    if($result && mysqli_num_rows($result) > 0)
    {
        echo "
        <head>
            <link rel='stylesheet' href='./Assets/DataTables/datatables.min.css'>
            <link rel='stylesheet' href='./Assets/DataTables/datatables.css'>
        </head>
        <div style='width:100%;height:650px;overflow:auto;'>
        <table id='example'>
        <button class='btn new_css_btn' onclick='closeTable()'>x</button>
        <thead>
            <tr class='trow'>
                <th>Issue Bookno</th>
                <th>Issue By</th>
                <th>Issue Date</th>
                <th>Return Date</th>
            </tr>
        </thead>
        <tbody>";
        $count=0;
        while($row=$result->fetch_assoc())
        {
            $count++;
            // if($count>5) break;
            echo"
            <tr>
            <td>".$row["Issue_Bookno"]."</td>
            <td>".$row["Issue_By"]."</td>
            <td>".$row["Issue_Date"]."</td>
            <td>".$row["Return_Date"]."</td>
            </tr>
            ";
        }
        echo "</tbody>
        </table></div>
                <script src='./Assets/DataTables/datatables.js'></script>

                <script>
                    $(document).ready(function() {
                        $('#example').dataTable( {
                            jQueryUI: true
                        } );
                    } );
                </script>   
        <script>
            
            document.getElementById('aufield').style.display='none';
            document.getElementById('response7').style.display='block';
            document.getElementsByClassName('dabbe')[0].style.height='0';
            function closeTable()
            {
                document.getElementsByClassName('dabbe')[0].style.height='80vh';
                document.getElementById('response7').style.display='none';
                document.getElementById('aufield').style.display='flex';
                document.getElementById('aufield').style.alignItems='center';
                document.getElementById('aufield').style.justifyContent='center';
            }
        </script>";
    }
    else if(!$result)
    {
        echo "
        <div id='dialog-confirm' style='color:red;' title='⚠️Error'>
            <p class='notification-message'> $conn->error </p>
        </div>";
    }
    else if(mysqli_num_rows($result) <= 0)
        {
            echo "
                <div id='dialog-confirm' style='color:red;' title='⚠️Error'>
                    <p class='notification-message'>Data not found </p>
                </div>";
        }
    else
    {
        echo $conn->error;
    }
    echo"<script>
    $( function() {
      $( '#dialog-confirm' ).dialog({
        resizable: false,
        height: 'auto',
        width: 400,
        modal: true,
        buttons: {
          'Ok': function() {
            $( this ).dialog( 'close' );
          }
        }
      });
    } );
    </script>";
}

if($membership=="Student")
{
    $sql_mem="SELECT Issue_Bookno,Issue_By,Issue_Date,Return_Date FROM issue_return 
        where Member_Type='Student' and (Issue_Date>='$doi_from' and Issue_Date<='$doi_to'
            or Return_Date<='$doi_to' and Return_Date>='$doi_from');";
    show_table($sql_mem);
}
else if($membership=="Faculty")
{
    $sql_mem="SELECT Issue_Bookno,Issue_By,Issue_Date,Return_Date FROM issue_return 
        where Member_Type='Faculty' and (Issue_Date>='$doi_from' and Issue_Date<='$doi_to' 
            or Return_Date<='$doi_to' and Return_Date>='$doi_from');";
    show_table($sql_mem);
}
else
{
    $sql_mem="SELECT Issue_Bookno,Issue_By,Issue_Date,Return_Date FROM issue_return 
        where Issue_Date>='$doi_from' and Issue_Date<='$doi_to' 
            or Return_Date<='$doi_to' and Return_Date>='$doi_from';";
    show_table($sql_mem);
}
?>