<?php
@session_start();
//include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
include "../../Auth/auth.php";
if(!verification() || $_POST["Access"] != "Main-Search" )
{
    header("Location: /LibraryManagement/");

}
// elseif(!logCheck()){
//     echo "
//     <script>
//         window.alert('you have been searched out');
 
//     </script>";
// }
else
{
    date_default_timezone_set("Asia/Kolkata");
    function Book_No($bno)
    {
        include "../../connection/dbconnect.php";
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
                <head>
                    <link rel='stylesheet' href='./Assets/DataTables/datatables.min.css'>
                    <link rel='stylesheet' href='./Assets/DataTables/datatables.css'>
                </head>
                <style>
                    .hideScrollbar::-webkit-scrollbar{
                        display: none; 
                    }
                </style>
                <div style='overflow:auto;height:650px;' class='hideScrollbar'>
                <table id='example'>
                <div class='mt-3 d-flex justify-content-between align-items-center mb-3'>
                    <h1 style='color:aliceblue;'>Book Details</h1>
                    <button style='background-color:aliceblue;padding:0.5rem 1rem;border-radius:5px;' class='btn-close' onclick='closeTable()'></button>
                </div>
                <thead>
                    <tr>
                        <th>Book No.</th>
                        <th>Title</th>
                        <th>Author's</th>
                        <th>Publisher</th>
                        <th>No of Copies</th>
                        <th>Available</th>
                    </tr>
                </thead>
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
                </tr>
                ";
            }

            echo"
                </tbody></table></div>
                <script src='./Assets/DataTables/datatables.js'></script>

                <script>
                    $(document).ready(function() {
                        $('#example').dataTable( {
                            jQueryUI: true
                        } );
                    } );
                </script>   
                <script>
                    document.getElementById('SearchField').style.display='none';
                    document.getElementById('response5').style.display='flex';
                    document.getElementById('response5').style.alignItems='center';
                    document.getElementById('response5').style.justifyContent='center';
                    document.getElementById('form_display').style.display='none';
                    function closeTable(){
                        document.getElementById('form_display').style.display='flex';
                        document.getElementById('form_display').style.justifyContent='center';
                        document.getElementById('form_display').style.alignItems='center';
                        document.getElementById('SearchField').style.display='block';
                        document.getElementById('response5').style.display='none';
                    }
                </script>";

        }
        else if(mysqli_num_rows($result) == 0)
        {
            echo "
                <div id='dialog-confirm' style='color:red;' title='⚠️Error'>
                    <p class='notification-message'>Book data not found</p>
                </div>";
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
        else echo $conn->error;
    }

    function Search($bVal)
    {
        include "../../connection/dbconnect.php";
        $b = "%".$bVal."%";
        $sql = "SELECT Title,Edition,Book_No,Author1,Author2,Author3,Publisher from books where Author1 like '$b' or Author2 like '$b' or Author3 like '$b'
        or Title like '$b' or Publisher like '$b' ORDER BY Book_No;";
        $result=$conn->query($sql);
        displayTable($result, $conn);
    }
    
    function Book_Author($bauthor)
    {
        include "../../connection/dbconnect.php";
        $b ="%".$bauthor."%";
        $sql = "SELECT * from books where Author1 LIKE '$b' or Author2 LIKE '$b' or Author3 LIKE '$b' ORDER BY Book_No;";
        $result=$conn->query($sql);
        displayTable($result, $conn);
    }

    function Book_Name($bname)
    {
        include "../../connection/dbconnect.php";
        $b ="%".$bname."%";
        $sql = "SELECT * from books where Title LIKE '$b' ORDER BY Book_No;";
        $result=$conn->query($sql);
        displayTable($result, $conn);
    }

    if(filter_input(INPUT_POST,"soption")=="search")
    {
        $book = $_POST["book"];
        Search($book);
    }
    else if(filter_input(INPUT_POST,"soption")=="Book No.")
    {
        include "../../connection/dbconnect.php";
        $bno=$_POST["bookno"];
        $isNum = is_numeric($bno);
        $Search=Book_No($bno);
        $sql="SELECT Status from books where Book_No = '$bno';";
        $result=$conn->query($sql);
        $f=0;

        if($result && mysqli_num_rows($result)>0 && $isNum==1)
        {
            while($row=$result->fetch_assoc())
            {
                if($row["Status"] == "Available") $f=1;
            }
            if($f==1)
            {
                if($Search) echo"
                <div id='dialog-confirm' style='color:green;' title='Available ✅'>
                    <p class='notification-success-message'>Book $bno is Available and can be Issued!!!</p>
                </div>";
                else echo "
                <div id='dialog-confirm' style='color:red;' title='Not Found 🤡'>
                    <p class='notification-message'>Book $bno does not Exist</p>
                </div>";
            }
            else
            {
                if($Search) echo "
                <div id='dialog-confirm' style='color:red;' title='Not Available ❌'>
                    <p class='notification-message'>Book $bno is been Issued already!!!</p>
                </div>";
                else echo "
                <div id='dialog-confirm' style='color:red;' title='Not Found ❌'>
                    <p class='notification-message'>Book $bno does not Exist</p>
                </div>"; 
            }
        }
        else if(!$result) echo "
        <div id='dialog-confirm' style='color:red;' title='Error ❌'>
            <p class='notification-message'>$conn->error</p>
        </div>";
        else if($isNum != 1)echo "
        <div id='dialog-confirm' style='color:red;' title='Error ❌'>
            <p class='notification-message'>Enter a Valid Book Number</p>
        </div>";
        else
        {
            echo "
            <div id='dialog-confirm' style='color:red;' title='Not Found ❌'>
                <p class='notification-message'>Book $bno does not Exist</p>
            </div>";
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
