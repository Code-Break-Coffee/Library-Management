<?php
    if(!empty($_POST['user']) || !empty($_POST['pass']) || $_GET["value"]==1)
    {
        echo"
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Action Menu</title>
            <link rel='stylesheet' href='bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css'>
            <style>
                #menu:hover
                {
                    cursor: pointer;
                }
                #bordered
                {
                    position: absolute;
                    top:80px;
                    left:140px;
                    border-radius:50%;
                    width:120px;
                    height:120px;
                    border:3px solid aliceblue;
                }
            </style>
            <script src='bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js'></script>
            <script src='aesthetic.js'></script>
        </head>
        <body style='font-family: monospace;'>
            <!----------------------------------carousel----------------------------------->
            <center>
                <div id='carouselExampleSlidesOnly' class='carousel slide' data-bs-ride='carousel' style='width: 100%;height:100vh;'>
                    <div class='carousel-inner'>
                        <div class='carousel-item active'>
                            <img src='lib_1.jpg' class='d-block w-100' alt='library' style='height:100vh;'>
                        </div>
                        <div class='carousel-item'>
                            <img src='lib_2.jpg' class='d-block w-100' alt='library' style='height:100vh;'>
                        </div>
                        <div class='carousel-item'>
                            <img src='lib_3.jpg' class='d-block w-100' alt='library' style='height:100vh;'>
                        </div>
                        <div class='carousel-item'>
                            <img src='lib_4.jpg' class='d-block w-100' alt='library' style='height:100vh;'>
                        </div>
                    </div>
                </div>
            </center>
            <div id='bordered'></div>
            <!------------------------------carousel end----------------------------------->
            <h1 style='color: white; position: absolute; left: 150px; top: 100px; font-weight: bolder;'>
                <img src='menu.jpg' width='100' height='80' onclick='displayed();frame();' id='menu'/>
            </h1>

            <a href='insertion.html' id='insertion' class='btn btn-primary anchors' style='position: absolute; top: 100px; left: 150px;display:none;'><b>Insert a New Book</b></a>
            <a href='deletion.php' id='deletion' class='btn btn-primary anchors' style='position: absolute; top: 100px; left: 150px;display:none;'><b>Delete an Existing Book</b></a>
            <a href='issue.html' id='issue' class='btn btn-primary anchors' style='position: absolute; top: 100px; left: 150px;display:none;'><b>Issue a Book</b></a>
            <a href='return.html' id='return' class='btn btn-primary anchors' style='position: absolute; top: 100px; left: 150px;display:none;'><b>Return a Book</b></a>
            <a href='member.html' id='member' class='btn btn-primary anchors' style='position: absolute; top: 100px; left: 150px;display:none;'><b>Member Profile</b></a>
        </body>
        </html>
        ";
    }
    else
    {
        echo"<script>window.alert('Unauthorized access!!!');</script>";
    }
?>