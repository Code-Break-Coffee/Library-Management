<?php
    function verification($a = 0)
    {
        if(empty($_SESSION["username"]) || empty($_SESSION["Log"])){
            return false;
        }
        else{
        $u =$_SESSION["username"];
        $log =$_SESSION["Log"];
        date_default_timezone_set("Asia/Kolkata");
        if($a != 0)
        {
            include "../connection/dbconnect.php";
        }
        else
        {
            include "../../connection/dbconnect.php";
        }
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
        }
        return password_verify("$u"."$log"."$d", $hash);
    }
    
    }
?>