<?php
@session_start();
include "../../Auth/auth.php";

function membercheck($x, $y)
{
    if ($x) {
        while ($row = $x->fetch_assoc()) {
            if ($row["Member_ID"] == $y) {
                return true;
            }
        }
    }
    return false;
}

if (!verification() || $_POST["Access"] != "Main-Member-Books-Check") {
    header("Location: /LibraryManagement/");
} else {
    if (!empty($_POST["mem_id"])) {
        include "../../connection/dbconnect.php";
        $memid = $_POST["mem_id"];
        $memid = strtoupper($memid);
        $memid = str_replace("-", "", $memid);

        $sql_m = "SELECT * from member where Member_ID ='$memid' ;";
        $result_m = $conn->query($sql_m);

        $checkedm = membercheck($result_m, $memid);

        if ($checkedm) {

            $sql = "SELECT Book_No,Author1,Author2,Author3,Title,Edition from books where Status = '$memid';";
            $result = $conn->query($sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    echo
                        "
                        <div style='width:100%;overflow:auto;height:650px;'>
                            <h1 style='color:#ffffff;background-color: rgba(0, 0, 0, 0.2);backdrop-filter: blur(5px);width:200px;'><center>$memid</center></h1>
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
                    while ($row = $result->fetch_assoc()) {
                        echo
                            "
                                    <tr>
                                        <td>" . $row["Book_No"] . "</td>
                                        <td>" . $row["Author1"] . "</td>
                                        <td>" . $row["Author2"] . "</td>
                                        <td>" . $row["Author3"] . "</td>
                                        <td>" . $row["Title"] . "</td>
                                        <td>" . $row["Edition"] . "</td>
                                    </tr>
                                ";
                    }
                    echo
                        "
                                </tbody>
                            </table>
                        </div>
                        <script>
                            document.getElementById('member_books_check').style.transform='translate(-100%,0%)';
                            document.getElementById('response_member_books_check').style.top='25%';
                            document.getElementById('response_member_books_check').style.left='45%';
                        </script>
                    ";
                } else {
                    echo
                        "
                        <div style='color:green;' id='dialog-confirm' title='✅ No Dues'>
                        <p style='display: flex; align-items: center; justify-content: center; background-color: #e6f9e6; color: #28a745; padding: 1rem; border-radius: 8px; border: 1px solid #28a745; max-width: 400px; margin: 20px auto; font-weight: bold;'>
                            <span class='ui-icon ui-icon-check' style='margin-right: 8px;'></span>
                            Member $memid has no Books Dues at the moment!!!
                        </p> 
                            
                        </div>
                    ";
                }
            } else {
                echo
                    "
                    <div style='color:red;' id='dialog_member_books_check' title='❌ Error'>
                        <p><center>$conn->error</center></p>
                    </div>
                ";
            }
        }
        else{
            echo
                    "
                    <div style='color:red;' id='dialog-confirm' title='❌ Error'>
                        <p style='display: flex; align-items: center; justify-content: center; background-color: #f9e6e6; color: #a72c28; padding: 1rem; border-radius: 8px; border: 1px solid #a72828; max-width: 400px; margin: 20px auto; font-weight: bold;'>
                            <span class='ui-icon ui-icon-check' style='margin-right: 8px;'></span>
                            Member $memid Not Found
                        </p>
                    </div>
                ";
        }
    } else {
        echo "<script>window.open('./','_self');</script>";
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
