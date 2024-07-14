<?php
function verification($a = 0)
{
    if (empty($_SESSION["username"]) || empty($_SESSION["Log"])) {
        return false;
    } else {
        $u = $_SESSION["username"];
        $log = $_SESSION["Log"];
        date_default_timezone_set("Asia/Kolkata");
        if ($a != 0) {
            include "../connection/dbconnect.php";
        } else {
            include "../../connection/dbconnect.php";
        }
        $d = null;
        $hash = null;
        $sql_key = "SELECT Key_Session,Log , Log2 FROM temp_keys WHERE Username ='$u';";
        $result_key = $conn->query($sql_key);
        if ($result_key) {
            while ($row = $result_key->fetch_assoc()) {
                $hash = $row["Key_Session"];
                $d = $row["Log2"];
                $log = $row["Log"];
            }
            
        }

        return password_verify("$u" . "$log" . "$d", $hash);
    }
}

function logCheck($a = 0)
{
    $u = $_SESSION["username"];
    $log = $_SESSION["Log"];
    date_default_timezone_set("Asia/Kolkata");
    if ($a != 0) {
        include "../connection/dbconnect.php";
    } else {
        include "../../connection/dbconnect.php";
    }
    $sql_key = "SELECT Log FROM temp_keys WHERE Username ='$u';";
    $result_key = $conn->query($sql_key);
    $current = date(DATE_RFC2822);
    if ($result_key) {
        while ($row = $result_key->fetch_assoc()) {
            $log = $row["Log"];
        }
        $interval = (new DateTime($current))->diff(new DateTime($log));
        if ((int)($interval->format("%Y%M%D%H%i%s")) > 20) {
            unset($_SESSION["username"]);
            unset($_SESSION["RELOAD"]);
            unset($_SESSION["Log"]);
            unset($_SESSION["File"]);
            @session_destroy();
            echo "
                <script>
                    window.alert('you have been logged out');
                    window.location.reload();
                </script>";
            return false;
        }
        else
        {
            $sql= "UPDATE temp_keys SET Log = '$current' WHERE Username ='$u';";
            $conn->query($sql);
            $_SESSION["Log"] = $current;
            echo "
            <script>
                window.alert('you have been logged out 22');
            </script>";
            return true;
        }
    }

}
