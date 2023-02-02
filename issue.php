<?php
include "dbconnect.php";

    session_start();
    $b=$_POST["Book_No"];
    $m=$_POST["Member_ID"];
    $sql_b="SELECT * from books;";
    $sql_s="SELECT * from member_student;";
    $sql_f="SELECT * from member_faculty;";
    $sql_ir="SELECT * from issue_return;";
    $result=$conn->query($sql);

?>