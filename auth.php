<?php
    function verification()
    {
        $u =$_SESSION["username"];
        $log =$_SESSION["Log"];
        date_default_timezone_set("Asia/Kolkata");
        include "dbconnect.php";
        $d = null;
        $hash = null;
        $sql_key = "SELECT Key_Session, Log2 FROM temp_keys WHERE Username ='$u';";
        $result_key=$conn->query($sql_key);
        if($result_key)
        {
            while($row=$result_key->fetch_assoc())
            {
                $hash = $row["Key_Session"];
                $d = $row["Log2"];
            }
            // echo "$u $log $hash $d";
        }
        if (password_verify($u.$log.$d, $hash)) {
            return true;
        }
        else{
            return false;}
    
    }
?>