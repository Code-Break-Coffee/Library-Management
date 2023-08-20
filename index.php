<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        .heading
        {
            font-family: HeadingBold;
            background-color: #092435;
            color: #bbf0e8;
        }
        @font-face {
            font-family: HeadingBold;
            src: url(BebasNeue-Bold.ttf);
        }
        @font-face {
            font-family: HeadingRegular;
            src: url(BebasNeue-Regular.ttf);
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
            cursor: pointer;
            background-color: #5cdb95;
            color:#05386b;
        }
        .hovered
        {
            color:#5cdb95;
        }
        [value="Student"]:hover
        {
            border: 2px solid aliceblue;
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
                        <button class="btn" style="font-weight: bold;background-color: #092435;color: aliceblue;" value="Student" id="student">Student</button>
                        <button type="reset" class="btn" style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button>
                        <br><br>
                    </center>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="bootstrap.bundle.js"></script>
<script src="Jquery.js"></script>
<script>
    $(document).ready(function()
    {
        $("#login").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
                method: "post",
                url: "Login.php",
                data: $(this).serialize(),
                datatype: "text",
                success: function(Result)
                {
                    $("body").html(Result);
                }
            });
        });
        $("#student").click(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
                method: "post",
                url: "Login.php",
                data: $(this).serialize(),
                datatype: "text",
                success: function(Result)
                {
                    $("body").html(Result);
                }
            });
        });
    });
    document.addEventListener('contextmenu', event => event.preventDefault());
    document.addEventListener('beforeunload',(e)=>
    {
        e.preventDefault();
        e.returnValue="";
    });
</script>
</html>