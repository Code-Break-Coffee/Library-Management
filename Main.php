<?php
@session_start();
include "dbconnect.php";
@$u=$_SESSION["username"];
@$p=$_SESSION["password"];
$result=$conn->query("SELECT * from admin;");
$flag=0;
if($result)
{
    while($row=$result->fetch_assoc())
    {
        if($row["Username"] == $u && $row["Password"] == $p)
        {
            $flag=1;
            echo '<!DOCTYPE html>
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
                background-color: #5cdb95;
                color:#05386b;
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
                height:82.1vh;
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
        </style>
    </head>
    <body>
        <center>
        <div class="row" style="width:100vw;">
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 heading">
                <h1>International Institute of Professional Studies</h1>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 heading">
                <h1>Library</h1>
                <form id="logout" method="post" action="">
                    <input type="submit" value="Logout" class="form-control bg-danger" style="width:50%;font-size: large;font-weight: bolder;color: aliceblue;"/>
                </form>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 heading">
                <h1>Devi Ahilya<br>Vishva Vidyalaya</h1>
            </div>
        </div>
        </center>
        <div style="background-color: #05386b;width:100vw;height:5px;"></div>
        <div style="background-color: #05386b;font-size: large;font-weight: bold;">
            <nav class="navbar navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-expand-xl navbar-expand">
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-fill w-100">
                        <li class="nav-item">
                            <a class="nav-link hovered" id="i">Issue</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hovered" id="r">Return</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hovered" id="ins">Insert</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hovered" id="d">Delete</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hovered" id="m">Member</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div id="contain">
        </div>
    </body>
    <script src="bootstrap.bundle.js"></script>
    <script src="Jquery.js"></script>
    <script src="Menu.js"></script>
    <script>
        $(document).ready(function()
        {
            $("#logout").submit(function(e)
            {
                e.preventDefault();
                $.ajax(
                {
                    method: "post",
                    url: "Logout.php",
                    data: $(this).serialize(),
                    dataType: "text",
                    success: function(Result)
                    {
                        $("body").html(Result);
                    }
                });
            });
        });
    </script>
    </html>';
        }
    }
}
if($flag==0)
{
    echo "<script>window.alert('Unauthorized Access!!!');</script>";
    include "index.html";
}
session_destroy();
?>