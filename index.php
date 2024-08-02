<?php
@session_start();
$_SESSION["File"] = "Index.php";
?>
<!DOCTYPE html>
<html lang="en">   
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="Assets\\css\\bootstrap.css">
    <link rel="stylesheet" href="./jquery-ui-1.13.2.custom/jquery-ui.css">
    <link rel="stylesheet" href="./jquery-ui-1.13.2.custom/jquery-ui.structure.css">
    <link rel="stylesheet" href="./jquery-ui-1.13.2.custom/jquery-ui.theme.css">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <script src="./jquery-ui-1.13.2.custom/jquery-ui.min.js"></script>
</head>
<body>
    <center>
    <div class="heading" id="Title_nev">
        <div class="heading_sub">
            <img src="./Assets/img/iips_logo2.png" alt="logo" width="100" height="100"/>
            <div style="text-align: left;font-family:product;font-size:x-large;">International Institute<br> of Professional Studies</div>
        </div>
        <div>
            <div>
                <div style="font-family: product_bold;font-size:x-large;">Library</div>
            </div>
            <div>
                <button type="submit" id="Student" value="Student" class="btn">Student</button>
                <form id="logout" method="post" action="Auth\\Logout.php" style="display:none;">
                    <input type="submit" id="logoutbtn" value="Logout" class="form-control btn" />
                </form>
            </div>
        </div>
        <div class="heading_sub">
            <div style="text-align: right;font-family:product;font-size:x-large;">Devi Ahilya<br>Vishva Vidyalaya</div>
            <img src="./Assets/img/Davv_Logo.png" alt="logo" width="100" height="100"/>
        </div>
    </div>
    </center>
    <div id="contain">
        <div style="font-weight:bold;width:500px;height:500px;position:absolute;top:50%;left:50%;translate: -50% -35%;background-color:rgba(120, 62, 18, 0.7);border-radius:10%;backdrop-filter: blur(5px);color:#ffffff;">
            <div style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%)">
                <form id="login" method="post" action="" autocomplete="off">
                    <center>
                        <h1 style="color:#ffffff;">Login Page</h1><br>
                        <label style="font-weight: bold;">Username:</label>
                        <input required type="text" name="username" class="form-control" style="background-color:#401B00;width:100%;color:#ffffff;" placeholder="Enter Username"/><br>
                        <label style="font-weight: bold;">Password:</label>
                        <input required type="password" name="password" class="form-control" style="background-color:#401B00;width:100%;color:#ffffff;" placeholder="Enter Password"/><br>
                        <input type="submit" class="btn" style="color:black;background-color: white;font-weight: bold;" value="Login"/>
                        <button type="reset" class="btn" style="font-weight: bold;background-color: white;color: black;">Clear</button>
                        <br><br>
                    </center>
                </form>
            </div>
        </div>
    </div>
    <script src="Assets\\js\\Jquery.js"></script>
<?php

if(!empty($_SESSION["RELOAD"]))
{
    if($_SESSION["RELOAD"] == "reload")
    {
        $x=$_SERVER["DOCUMENT_ROOT"];
            echo"
            <script>
                $.ajax(
                {
                    method: 'post',
                    url: './Assets/php/Main.php',
                    error: function()
                    {
                        alert('Some Error Occurred!!!');
                    },
                    success: function(Result)
                    {
                        document.querySelector('#Student').style.display='none';
                        document.querySelector('#logout').style.display='block';
                        $('#contain').html(Result);
                    }
                });
            </script>
            ";
    }
}
?>
</body>
<script src="Assets\\js\\bootstrap.bundle.js"></script>
<script src="Assets\\js\\index.js"></script>
</html>