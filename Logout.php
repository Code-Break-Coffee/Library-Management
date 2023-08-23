<?php
session_start();
unset($_SESSION["username"]);
session_destroy();
include "index.php";
echo "<script>window.location.reload();</script>";
?>