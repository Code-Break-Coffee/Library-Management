<?php
@session_start();
include "../connection/dbconnect.php";
include "../Auth/auth.php";

function password_check($p, $pc)
{
    if ($p == $pc) {
        return true;
    }
    return false;
}

function PHash($use, $pass)
{
    return password_hash("$use" . "$pass", PASSWORD_BCRYPT);
}

function AdminExist($u)
{
    include "../connection/dbconnect.php";
    $sql = "SELECT Username FROM admin WHERE Username = '$u';";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) >= 1) {
        return true;
    } else {
        return false;
    }
}
if (!verification(1) || $_POST["Access"] != "Main-administrator") 
{
    header("Location: /LibraryManagement/");
}
else 
{
    $user = $_POST["admin_user"];
    $password = $_POST["admin_pass"];
    $pass_confirm = $_POST["admin_pass_conf"];
    if (!AdminExist($user)) {

        if (password_check($password, $pass_confirm) && $password==$pass_confirm) {
            $p = PHash($user, $password);
            $stat = "INSERT INTO admin VALUES('$user','$p','Assistant');";
            $stat1 = "INSERT INTO temp_keys(Username) VALUES('$user');";
            $result = $conn->query($stat);
            $result1 = $conn->query($stat1);
            if ($result) {
                echo "
            <div id='dialog_adminstrator' style='color:green;' title='✅Successful'>
                <p><center>User Created Successfully</center></p>
            </div>
            ";
            } else {
                echo "
            <div id='dialog_adminstrator' style='color:red;' title='⚠️Error'>
                <p><center>$conn->error</center></p>
            </div>
            ";
            }
        } else {
            echo "
        <div id='dialog_adminstrator' style='color:red;' title='⚠️Error'>
            <p><center>Confirmation Password Is Not Same as Password</center></p>
        </div>
        ";
        }
    } else {
        echo "
        <div id='dialog_adminstrator' style='color:red;' title='⚠️Error'>
            <p><center>User already exists</center></p>
        </div>
        ";
    }
}



