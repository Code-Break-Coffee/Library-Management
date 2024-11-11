<?php
@session_start();
include "../../Auth/auth.php";
include "../../connection/dbconnect.php";

if(!verification() || $_POST["Access"] != "Main-Book-Filter") {
    header("Location: /LibraryManagement/");
} else {
    if ((strlen($_POST["title"]) >= 1 && strlen($_POST["title"]) < 3) || 
        (strlen($_POST["author"]) >= 1 && strlen($_POST["author"]) < 3) || 
        (strlen($_POST["publisher"]) >= 1 && strlen($_POST["publisher"]) < 3) || 
        (strlen($_POST["supplier"]) >= 1 && strlen($_POST["supplier"]) < 3)) {
        echo "
        <div id='dialog_filter_disp' style='color:red;' title='❌Not Allowed'>
            <p><center>Minimum 3 letter input must be given in any input field</center></p>
        </div>";
    } else {
        $sql = "SELECT * FROM books WHERE ";
        $conditions = [];

        if (!empty($_POST["title"])) {
            $title = $_POST["title"];
            $conditions[] = "Title LIKE '%$title%'";
        }
        if (!empty($_POST["author"])) {
            $author = $_POST["author"];
            $conditions[] = "(Author1 LIKE '%$author%' OR Author2 LIKE '%$author%' OR Author3 LIKE '%$author%')";
        }
        if (!empty($_POST["publisher"])) {
            $publisher = $_POST["publisher"];
            $conditions[] = "Publisher LIKE '%$publisher%'";
        }
        if (!empty($_POST["supplier"])) {
            $supplier = $_POST["supplier"];
            $conditions[] = "Supplier LIKE '%$supplier%'";
        }

        $sql .= $conditions ? implode(" AND ", $conditions) : "1=1";

        $result = $conn->query($sql);
        if ($result) {
            echo "
            <head>
                <link rel='stylesheet' href='./Assets/DataTables/datatables.min.css'>
                <style>
                    body { font-family: Arial, sans-serif; background-color: #1e1e2f; color: #ddd; }
                    #filt_table { width: 100%; }
                    h1 { color: #f4f4f4; }
                    .btn-close { background-color: white; color: black; font-weight: bold; padding: 0.5rem 1rem; border-radius: 5px; }
                    .btn-close:hover { background-color: #ccc; }
                    .table-wrapper { max-height: 500px; overflow-y: auto; overflow-x: auto; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { padding: 0.5rem; text-align: left; border-bottom: 1px solid #ddd; }
                    tbody tr:hover {
                        background: #000000 !important;
                    }
                    .hideScrollbar::-webkit-scrollbar{
                        display: none; 
                        }
                </style>
            </head>
            <div id='filt_table' class='container mt-4'>
                <center>
                    <div class='d-flex align-items-center justify-content-between'>
                        <h1>Book Filter Results</h1>
                        <button class='btn-close' onclick='GetBack()'></button>
                    </div>
                    <div class='table-wrapper hideScrollbar'>
                        <table id='example' class='table ' class='display'>
                            <thead>
                                <tr>
                                    <th class='row_head'>Book No.</th>
                                    <th class='row_head'>Title</th>
                                    <th class='row_head'>Author 1</th>
                                    <th class='row_head'>Author 2</th>
                                    <th class='row_head'>Author 3</th>
                                    <th class='row_head'>Edition</th>
                                    <th class='row_head'>Publisher</th>
                                    <th class='row_head'>CL No.</th>
                                    <th class='row_head'>Total Pages</th>
                                    <th class='row_head'>Cost</th>
                                    <th class='row_head'>Supplier</th>
                                    <th class='row_head'>Bill No.</th>
                                    <th class='row_head'>Remark</th>
                                    <th class='row_head'>Status</th>
                                </tr>
                            </thead>
                            <tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "
                                <tr>
                                    <td>{$row['Book_No']}</td>
                                    <td>{$row['Title']}</td>
                                    <td>{$row['Author1']}</td>
                                    <td>{$row['Author2']}</td>
                                    <td>{$row['Author3']}</td>
                                    <td>{$row['Edition']}</td>
                                    <td>{$row['Publisher']}</td>
                                    <td>{$row['Cl_No']}</td>
                                    <td>{$row['Total_Pages']}</td>
                                    <td>{$row['Cost']}</td>
                                    <td>{$row['Supplier']}</td>
                                    <td>{$row['Bill_No']}</td>
                                    <td>{$row['Remark']}</td>
                                    <td>{$row['Status']}</td>
                                </tr>";
            }
            echo "
                            </tbody>
                        </table>
                    </div>
                </center>
            </div>
            <script src='./Assets/DataTables/datatables.js'></script>
            <script>
                $(document).ready(function() {
                    $('#example').DataTable({
                        jQueryUI: true,
                        responsive: true,
                        scrollX: true
                    });
                });
                
                function GetBack() {
                    document.getElementById('bookfilter_form').style.display = 'block';
                    document.getElementById('zak_container').style.display = 'block';
                    document.getElementById('filt_table').style.display = 'none';
                }
            </script>";
        } else {
            echo "
            <div id='dialog_filter_disp' style='color: white;' title='❌Not Allowed'>
                <p><center>Something Went Wrong</center></p>
            </div>";
        }
    }
}
?>
