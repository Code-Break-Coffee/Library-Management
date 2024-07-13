<?php
@session_start();
if($_SESSION["File"] != "Index.php" || $_POST["Access"] != "Index-Login")
{
    header("Location: /LibraryManagement/");
}
unset($_SESSION["username"]);
unset($_SESSION["RELOAD"]);
unset($_SESSION["Log"]);

include '../connection/dbconnect.php' ;
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
            if($row["Username"] == $user && password_verify("$user"."$pass", $row["Password"]))
            {
                $_SESSION["username"]=$user;
                $flag = 1;
                include "KeyGen.php";
                Gen();
                include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Assets/php/Main.php";
                // $sql_delete = "DELETE from `insert buffer`;"; // delete all the records from input buffer
                // $result=$conn->query($sql_delete);
            }
        }
    }
    else if (!$result) echo $conn->error;
    else 
    {
        echo "<script>alert('User $user not Found!!!');</script>";
        echo '
            <div style="font-weight:bold;width:600px;height:600px;position:absolute;top:50%;left:50%;translate: -50% -35%;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
                <div style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                    <form id="login" method="post" action="" autocomplete="off">
                        <center>
                            <h1 style="color:aliceblue;">Login Page</h1>
                            <label style="font-weight: bold;">Username:</label>
                            <input required type="text" name="username" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter Username"/><br>
                            <label style="font-weight: bold;">Password:</label>
                            <input required type="password" name="password" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter Password"/><br>
                            <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Login"/>
                            <button type="reset" class="btn" style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button>
                            <br><br>
                        </center>
                    </form>
                </div>
            </div>
            <script>
                window.open("index.php","_self");
            </script>';
        $flag = 2;
    }
    if($flag == 0)
    {
        echo "<script>alert('User and Password do not match!!!');</script>";
        echo '
        <div style="font-weight:bold;width:600px;height:600px;position:absolute;top:50%;left:50%;translate: -50% -35%;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
            <div style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                <form id="login" method="post" action="" autocomplete="off">
                    <center>
                        <h1 style="color:aliceblue;">Login Page</h1>
                        <label style="font-weight: bold;">Username:</label>
                        <input required type="text" name="username" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter Username"/><br>
                        <label style="font-weight: bold;">Password:</label>
                        <input required type="password" name="password" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter Password"/><br>
                        <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Login"/>
                        <button type="reset" class="btn" style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button>
                        <br><br>
                    </center>
                </form>
            </div>
        </div>
        <script>
            window.open("index.php","_self");
        </script>';
    }
}
else
{
    include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/index.php";
    echo '
        <script>
            document.getElementById("contain").innerHTML=`
            <div style="font-weight:bold;width:600px;height:600px;position:absolute;top:50%;left:50%;translate: -50% -35%;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
            <div style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                <form id="login" method="post" action="" autocomplete="off">
                    <center>
                        <h1 style="color:aliceblue;">Login Page</h1>
                        <label style="font-weight: bold;">Username:</label>
                        <input required type="text" name="username" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter Username"/><br>
                        <label style="font-weight: bold;">Password:</label>
                        <input required type="password" name="password" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter Password"/><br>
                        <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Login"/>
                        <button type="reset" class="btn" style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button>
                        <br><br>
                    </center>
                </form>
            </div>
        </div>
            `;
        </script>';
}
?>