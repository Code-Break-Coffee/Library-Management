<?php
@session_start();
unset($_SESSION["username"]);
unset($_SESSION["RELOAD"]);
unset($_SESSION["Log"]);
unset($_SESSION["File"]);
@session_destroy();
header("Location: /LibraryManagement/");
?>