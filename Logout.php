<?php
session_start();
unset($_SESSION["username"]);
session_destroy();
header("Location: /LibraryManagement/index.php");
echo "<script>window.location.reload();</script>";
?>