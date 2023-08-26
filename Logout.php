<?php
@session_start();
unset($_SESSION["username"]);
unset($_SESSION["TEMP"]);
unset($_SESSION["Log"]);
unset($_SESSION["File"]);
@session_destroy();
header("Location: /LibraryManagement/index.php");
?>