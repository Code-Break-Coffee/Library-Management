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
            echo '
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
                                        <a class="nav-link hovered" id="s">Search</a>
                                    </li>
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
                    <div id="contain"></div>
                </body>
                <script src="bootstrap.bundle.js"></script>
                <script src="Jquery.js"></script>
                <script>
                    document.getElementById("d").addEventListener("click",()=>
                    {
                        var container=document.getElementById("contain");
                            container.innerHTML=`
                            <div style="font-weight:bold;width:50vw;height:50vh;position:absolute;top:50%;left:50%;translate: -50% -35%;border-radius: 5px;background-color: #5cdb95;color:#05386b;border-color: #05386b;border-width: 5px;border-style: solid;">
                                <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                                    <form id="deleteform" method="post" action="">
                                        <center>
                                            <h1>Book Delete Form</h1>
                                            <label>Book Number:</label>
                                            <input type="text" name="bookno" class="form-control" style="width:100%;" placeholder="Scan the Barcode or Enter Book No."/><br>
                                            <input type="submit" class="btn" style="color:aliceblue;background-color: #05386b;font-weight: bold;" value="Delete"/>
                                            <button type="reset" class="btn btn-danger" style="font-weight: bold;">Clear</button><br><br>
                                            <div style="color:red;font-weight: bold;" id="response4"></div>
                                        </center>
                                    </form>
                                </div>
                            </div>`;
                        $(document).ready(function()
                        {
                            $("#deleteform").submit(function(e)
                            {
                                e.preventDefault();
                                $.ajax(
                                {
                                    method: "post",
                                    url: "Delete.php",
                                    data: $(this).serialize(),
                                    datatype: "text",
                                    success: function(Result)
                                    {
                                        $("#response4").html(Result);
                                    }
                                });
                            });
                        });
                    });

                    document.getElementById("i").addEventListener("click",()=>
                    {
                        var container=document.getElementById("contain");
                        container.innerHTML=`
                        <div style="font-weight:bold;width:50vw;height:50vh;position:absolute;top:50%;left:50%;translate: -50% -35%;border-radius: 5px;background-color: #5cdb95;color:#05386b;border-color: #05386b;border-width: 5px;border-style: solid;">
                            <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                                <form id="issuebook" method="post" action="">
                                    <center>
                                        <h1>Book Issue Form</h1>
                                        <label>Book Number:</label>
                                        <input required type="text" name="bookno" class="form-control" style="width:100%;" placeholder="Scan the Barcode or Enter Book No."/><br>
                                        <label>Member ID:</label>
                                        <input required type="text" name="memberid" class="form-control" style="width:100%;" placeholder="Scan the Barcode or Enter Member ID"/><br>
                                        <label>Member Type:</label><br><label class="form-check-label">Student:</label>&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="membertype" checked class="form-check-input" value="Student"/>
                                        <label class="form-check-label">Faculty:</label>&nbsp;&nbsp;
                                        <input type="radio" name="membertype" class="form-check-input" value="Faculty"/><br><br>
                                        <input type="submit" class="btn" style="color:aliceblue;background-color: #05386b;font-weight: bold;" value="Issue"/>
                                        <button type="reset" class="btn btn-danger" style="font-weight: bold;">Clear</button><br><br>
                                        <div style="color:red;font-weight: bold;" id="response"></div>
                                    </center>
                                </form>
                            </div>
                        </div>`;
                        $(document).ready(function()
                        {
                            $("#issuebook").submit(function(e)
                            {
                                e.preventDefault();
                                $.ajax(
                                {
                                    method: "post",
                                    url: "Issue.php",
                                    data: $(this).serialize(),
                                    datatype: "text",
                                    success: function(Result)
                                    {
                                        $("#response").html(Result);
                                    }
                                });
                            });
                        });
                    });

                    document.getElementById("r").addEventListener("click",()=>
                    {
                        var container=document.getElementById("contain");
                        container.innerHTML=`
                        <div style="font-weight:bold;width:50vw;height:50vh;position:absolute;top:50%;left:50%;translate: -50% -35%;border-radius: 5px;background-color: #5cdb95;color:#05386b;border-color: #05386b;border-width: 5px;border-style: solid;">
                            <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                                <form id="returnform" method="post" action="">
                                    <center>
                                        <h1>Book Return Form</h1>
                                        <label>Book Number:</label>
                                        <input type="text" name="bookno" class="form-control" style="width:100%;" placeholder="Scan the Barcode or Enter Book No."/><br>
                                        <label>Member ID:</label>
                                        <input type="text" name="memberid" class="form-control" style="width:100%;" placeholder="Scan the Barcode or Enter Member ID"/><br>
                                        <label>Member Type:</label><br>
                                        <label class="form-check-label">Student:</label>&nbsp;&nbsp;<input type="radio" name="membertype" checked class="form-check-input" value="Student"/>
                                        <label class="form-check-label">Faculty:</label>&nbsp;&nbsp;<input type="radio" name="membertype" class="form-check-input" value="Faculty"/><br><br>
                                        <input type="submit" class="btn" style="color:aliceblue;background-color: #05386b;font-weight: bold;" value="Return"/>
                                        <button type="reset" class="btn btn-danger" style="font-weight: bold;">Clear</button><br><br>
                                        <div style="color:red;font-weight: bold;" id="response2"></div>
                                    </center>
                                </form>
                            </div>
                        </div>`;
                        $(document).ready(function()
                        {
                            $("#returnform").submit(function(e)
                            {
                                e.preventDefault();
                                $.ajax(
                                {
                                    method: "post",
                                    url: "Return.php",
                                    data: $(this).serialize(),
                                    datatype: "text",
                                    success: function(Result)
                                    {
                                        $("#response2").html(Result);
                                    }
                                });
                            });
                        });
                    });

                    document.getElementById("ins").addEventListener("click",()=>
                    {
                        var container=document.getElementById("contain");
                        container.innerHTML=`
                        <div style="font-weight:bold;width:50vw;height:70vh;position:absolute;top:50%;left:50%;translate: -50% -35%;border-radius: 5px;background-color: #5cdb95;color:#05386b;border-color: #05386b;border-width: 5px;border-style: solid;">
                            <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                                <form id="insertform" method="post" action="">
                                    <center>
                                        <h1>Book Insert Form</h1>
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Book Number:</label>
                                                <input required type="text" name="bookno" class="form-control" style="width:100%;" placeholder="Scan the Barcode or Enter Book No."/>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Title:</label>
                                                <input required type="text" name="title" class="form-control" style="width:100%;"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Edition:</label>
                                                <input required type="text" name="edition" class="form-control" style="width:100%;"/>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Author 1:</label>
                                                <input required type="text" name="author1" class="form-control" style="width:100%;"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Author 2:</label>
                                                <input type="text" name="author2" class="form-control" style="width:100%;"/>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Author 3:</label>
                                                <input type="text" name="author3" class="form-control" style="width:100%;"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Publisher:</label>
                                                <input required type="text" name="publisher" class="form-control" style="width:100%;"/>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Supplier:</label>
                                                <input type="text" name="supplier" class="form-control" style="width:100%;"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Cost:</label>
                                                <input type="number" name="cost" class="form-control" style="width:100%;"/>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Total Pages:</label>
                                                <input required type="number" name="totalpages" class="form-control" style="width:100%;"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                                                <label>Bill Number:</label>
                                                <input type="text" name="billno" class="form-control" style="width:100%;"/>
                                            </div>
                                        </div><br>
                                        <input type="submit" class="btn" style="color:aliceblue;background-color: #05386b;font-weight: bold;" value="Insert"/>
                                        <button type="reset" class="btn btn-danger" style="font-weight: bold;">Clear</button><br><br>
                                        <div style="color:red;font-weight: bold;" id="response3"></div>
                                    </center>
                                </form>
                            </div>
                        </div>`;
                        $(document).ready(function()
                        {
                            $("#insertform").submit(function(e)
                            {
                                e.preventDefault();
                                $.ajax(
                                {
                                    method: "post",
                                    url: "Insert.php",
                                    data: $(this).serialize(),
                                    datatype: "text",
                                    success: function(Result)
                                    {
                                        $("#response3").html(Result);
                                    }
                                });
                            });
                        });
                    });

                    document.getElementById("s").addEventListener("click",()=>
                    {
                        var container=document.getElementById("contain");
                        container.innerHTML=`
                        <div style="font-weight:bold;width:50vw;height:50vh;position:absolute;top:50%;left:50%;translate: -50% -35%;border-radius: 5px;background-color: #5cdb95;color:#05386b;border-color: #05386b;border-width: 5px;border-style: solid;">
                            <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                                <form id="searchform" method="post" action="">
                                    <center>
                                        <h1>Book Search Form</h1>
                                        <label>Book Number:</label>
                                        <input type="text" name="bookno" class="form-control" style="width:100%;" placeholder="Scan the Barcode or Enter Book No."/><br>
                                        <input type="submit" class="btn" style="color:aliceblue;background-color: #05386b;font-weight: bold;" value="Delete"/>
                                        <button type="reset" class="btn btn-danger" style="font-weight: bold;">Clear</button><br><br>
                                        <div style="color:red;font-weight: bold;" id="response5"></div>
                                    </center>
                                </form>
                            </div>
                        </div>`;
                        $(document).ready(function()
                        {
                            $("#searchform").submit(function(e)
                            {
                                e.preventDefault();
                                $.ajax(
                                {
                                    method: "post",
                                    url: "Search.php",
                                    data: $(this).serialize(),
                                    datatype: "text",
                                    success: function(Result)
                                    {
                                        $("#response5").html(Result);
                                    }
                                });
                            });
                        });
                    });

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