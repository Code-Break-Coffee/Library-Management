<?php
    function verif()
    {
        // echo "<script>document.alert('Unauthorized Access or Inputs Not Given!!!');</script>";
        // include "index.php";
        echo "<script>document.alert('hola!!!');</script>";
        date_default_timezone_set("Asia/Kolkata");
        include "dbconnect.php";
        $d = date("ymNdis");
        $l = date(DATE_RFC2822);
        $u =$_SESSION["username"];
        $p = $_SESSION["password"];
        $log =$_SESSION["Log"];
        $hash = null;
        
        $sql_key = "SELECT Key_Session, Log FROM temp_keys WHERE Username ='$u';";
        $result_key=$conn->query($sql_key);
        if($result_key)
        {
            while($row=$result_key->fetch_assoc())
            {
                if($row["Log"] == $log)
                {
                    $hash = $row["Key_Session"];
                }
            }
        }else echo"<script>document.alert('$conn->error');</script>";
        if (password_verify($u.$log.$p.$d, $hash)) {
            echo "<script>document.alert('hola!!!');</script>";
        }
        else{echo "<script>document.alert('fuck!!!');</script>";}

    }
?>