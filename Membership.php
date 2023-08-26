<?php
@session_start();
include "dbconnect.php";
include "auth.php";
if(!verification())
{
    header("Location: /LibraryManagement/index.php");
}

echo "
<div id='dialog8' style='color:green;' title='Successfull'>
    <p><center>Done</center></p>
</div>
"; ?>