<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        @font-face
        {
            font-family: HeadingBold;
            src: url(BebasNeue-Bold.ttf);
        }
        @font-face
        {
            font-family: HeadingRegular;
            src: url(BebasNeue-Regular.ttf);
        }
        #logoutbtn:hover
        {
            border: 2px 2px solid aliceblue;
        }
        #container
        {
            background: url(library.jpg);
            background-repeat: repeat-y ;
            background-position: center;
            background-size: cover;
            width:100%;
            height:769px;
        }
        .heading
        {
            font-family: HeadingBold;
            background-color: #092435;
            color: #bbf0e8;
        }
        body 
        {
            overflow: hidden;
        }
        #contain
        {
            background: url(library.jpg);
            background-repeat: no-repeat ;
            background-position: center;
            background-size: cover;
            width:100vw;
            height:828px;
        }
        [type="submit"]:hover
        {
            border: 2px solid aliceblue;
        }
        [type="reset"]:hover
        {
            border: 2px solid aliceblue;
        }
        .hovered:hover
        {
            cursor: pointer !important;
            background-color: #61908a !important;
            color:#092435 !important;
        }
        .dropdown_hover:hover
        {
            background-color: #092435;
            color: aliceblue;
        }
        .hovered:focus
        {
            color: #61908a;
        }
        .hovered
        {
            color:#61908a;
        }
        [value="Student"]:hover
        {
            border: 2px solid aliceblue;
        }
        table 
        {
            background: #012B39;
            border-radius: 0.25em;
            border-collapse: collapse;
        }
        th 
        {
            border-bottom: 1px solid #364043;
            color: #E2B842;
            text-align: center;
            font-size: 0.85em;
            font-weight: 600;
            padding: 0.5em 1em;
        }
        td 
        {
            color: #fff;
            text-align: center;
            font-weight: 400;
            padding: 0.65em 1em;
        }

        tbody tr 
        {
            transition: background 0.25s ease;
        }
        tbody tr:hover {
            background: #014055;
        }
    </style>
    <link rel="stylesheet" href="./jquery-ui-1.13.2.custom/jquery-ui.css">
    <link rel="stylesheet" href="./jquery-ui-1.13.2.custom/jquery-ui.structure.css">
    <link rel="stylesheet" href="./jquery-ui-1.13.2.custom/jquery-ui.theme.css">
</head>
<body>
    <center>
    <div class="row" style="width:100vw;">
        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 heading">
            <h1>International Institute of Professional Studies</h1>
        </div>
        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 heading">
            <h1>Library</h1>
            <form id="Student" method="post" action="student.html" target="_blank">
                <input type="submit" id="studentbtn" value="Student" class="form-control bg-danger" style="width:50%;font-size: large;font-weight: bolder;color: aliceblue;"/>
            </form>
            <form id="logout" method="post" action="Logout.php" style="display:none;">
                <input type="submit" id="logoutbtn" value="Logout" class="form-control bg-danger" style="width:200px; font-size: large;font-weight: bolder;color: aliceblue;"/>
            </form>
        </div>
        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 heading">
            <h1>Devi Ahilya<br>Vishva Vidyalaya</h1>
        </div>
    </div>
    </center>
    <div id="contain">
        <div style="font-weight:bold;width:600px;height:600px;position:absolute;top:50%;left:50%;translate: -50% -35%;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
            <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
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
    </div>
</body>
<script src="Jquery.js"></script>
<?php
    if(!empty($_SESSION["TEMP"]))
    {
            echo'
            <script>
                $.ajax(
                {
                    method: "post",
                    url: "Main2.php",
                    data: $(this).serialize(),
                    datatype: "text",
                    success: function(Result)
                    {
                        document.getElementById("Student").style.display="none";
                        document.getElementById("logout").style.display="block";
                        $("#contain").html(Result);
                    }
                });
            </script>
            ';
    }
?>
<script src="bootstrap.bundle.js"></script>
<script src="index.js"></script>
</html>