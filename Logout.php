<?php
@session_start();
unset($_SESSION["username"]);
unset($_SESSION["TEMP"]);
@session_destroy();
header("Location: /LibraryManagement/index.php");
?>