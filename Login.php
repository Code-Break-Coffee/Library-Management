<?php
@session_start();
unset($_SESSION["username"]);
unset($_SESSION["TEMP"]);
unset($_SESSION["Log"]);
include "dbconnect.php";
$user;$pass;
if(!empty($_POST["username"]) && !empty($_POST["password"]))
{
    $user=$_POST["username"];
    $pass=$_POST["password"];

    
    $sql="SELECT * from admin where Username = '$user';";
    $result=$conn->query($sql);
    $flag = 0;
    if($result && mysqli_num_rows($result) > 0)
    {
        while($row=$result->fetch_assoc())
        {
            if($row["Username"] == $user && $row["Password"] == $pass)
            {
                $_SESSION["username"]=$user;
                $flag = 1;
                include "KeyGen.php";
                Gen();
                include "Main.php";
            }
        }
    }
    else if (!$result) echo $conn->error;
    else 
    {
        header("Location: /LibraryManagement/index.php");
        $flag = 2;
        echo "bsdk";
    }
    if($flag == 0)
    {
        header("Location: /LibraryManagement/index.php");
        echo "login fail";
    }
}
else
{
    header("Location: /LibraryManagement/index.php");
    echo "fuck";
}
?>