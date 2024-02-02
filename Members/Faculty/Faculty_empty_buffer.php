<?php
    include "../../connection/dbconnect.php";
    $sql_delete = "DELETE from `insert buffer`;";
    $result=$conn->query($sql_delete);
?>