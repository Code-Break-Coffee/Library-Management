<?php
if(empty($_SESSION["username"]) || empty($_SESSION["password"]))
{
    echo "<script>window.alert('Unauthorized Access!!!');</script>";
    include "index.php";
}
else
{
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
                        #logoutbtn:hover
                        {
                            box-shadow: 3px 3px 3px aliceblue;
                        }
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
                        [type="submit"]:hover
                        {
                            border: 2px solid aliceblue;
                        }
                        [type="reset"]:hover
                        {
                            border: 2px solid aliceblue;
                        }
                        #contain
                        {
                            background: url(library.jpg);
                            background-repeat: repeat-y ;
                            background-position: center;
                            background-size: cover;
                            width:100%;
                            height:82.1vh;
                        }
                        .hovered:hover
                        {
                            cursor: pointer !important;
                            background-color: #61908a !important;
                            color:#092435 !important;
                        }
                        .hovered
                        {
                            color:#61908a;
                        }
                    </style>
                </head>
                <body>
                    <center>
                        <!-- heading -->
                        <div class="row" style="width:100vw;">
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 heading">
                                <h1>International Institute of Professional Studies</h1>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 heading">
                                <h1>Library</h1>
                                <form id="logout" method="post" action="">
                                    <input type="submit" id="logoutbtn" value="Logout" class="form-control bg-danger" style="width:50%;font-size: large;font-weight: bolder;color: aliceblue;"/>
                                </form>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 heading">
                                <h1>Devi Ahilya<br>Vishva Vidyalaya</h1>
                            </div>
                        </div>
                    </center>
                    <!--navbar-->
                    <div style="background-color: black;width:100vw;height:5px;"></div>
                    <div style="background-color: black;font-size: large;font-weight: bold;">
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
                                    <li class="nav-item">
                                         <a class="nav-link hovered" id="au">Audit</a>
                                    </li>
                                    <li class="nav-item">
                                         <a class="nav-link hovered" id="me">Membership</a>
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

                    //delete

                    document.getElementById("d").addEventListener("click",()=>
                    {
                        let hovered = document.getElementsByClassName("hovered");
                        for(let i=0;i<hovered.length;i++)
                        {
                            hovered[i].style.color="#61908a";
                            hovered[i].style.backgroundColor="black";
                        }
                        document.querySelector("#d").style.color="black";
                        document.querySelector("#d").style.backgroundColor="aliceblue";
                        var container=document.getElementById("contain");
                            container.innerHTML=`
                            <div id="deletefield" style="font-weight:bold;width:600px;height:600px;position:absolute;top:50%;left:50%;translate: -50% -35%;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
                                <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                                    <form id="deleteform" method="post" action="" autocomplete="off">
                                        <center>
                                            <h1>Book Delete Form</h1>
                                            <label>Book Number:</label>
                                            <input required type="text" name="bookno" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Book No."/><br>
                                            <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Delete"/>
                                            <button type="reset" class="btn " style="font-weight: bold; background-color: #520702;color: aliceblue;">Clear</button><br><br>
                                        </center>
                                    </form>
                                </div>
                            </div>
                            <div style="font-weight: bold; background:url(Alert_Image.jpg); width: 600px; height: 350px; position: relative; background-repeat: no-repeat; background-size: cover; background-position: center; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none;" id="response4"></div>`;
                        $(document).ready(function()
                        {
                            $("#deleteform").submit(function(e)
                            {
                                e.preventDefault();
                                var conf=window.confirm("Are you sure you want to delete this book?");
                                if(conf)
                                {
                                    document.querySelector("#deletefield").style.display="none";
                                    document.querySelector("#response4").style.display="block";
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
                                }
                            });
                        });
                    });
                    
                    //issue

                    document.getElementById("i").addEventListener("click",()=>
                    {
                        let hovered = document.getElementsByClassName("hovered");
                        for(let i=0;i<hovered.length;i++)
                        {
                            hovered[i].style.color="#61908a";
                            hovered[i].style.backgroundColor="black";
                        }
                        document.querySelector("#i").style.color="black";
                        document.querySelector("#i").style.backgroundColor="aliceblue";
                        var container=document.getElementById("contain");
                        container.innerHTML=`
                        <div id="issuefield" style="font-weight:bold;width:600px;height:600px;position:absolute;top:50%;left:50%;translate: -50% -35%;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
                            <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                                <form id="issuebook" method="post" action="" autocomplete="off">
                                    <center>
                                        <h1>Book Issue Form</h1>
                                        <br>
                                        <label>Member Type:</label><br><label class="form-check-label">Student:</label>&nbsp;
                                        <input type="radio" name="membertype" checked class="form-check-input bg-dark" value="Student" style="color:aliceblue;"/>
                                        <label class="form-check-label">Faculty:</label>&nbsp;&nbsp;
                                        <input type="radio" name="membertype" class="form-check-input bg-dark" value="Faculty" style="color:aliceblue;"/><br><br>
                                        
                                        <label>Member ID:</label>
                                        <input required type="text" name="memberid" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Member ID"/><br>

                                        <label>Book Number:</label>
                                        <input required type="text" name="bookno" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Book No."/><br>

                                        <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Issue"/>
                                        <button type="reset" class="btn" style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                                    </center>
                                </form>
                            </div>
                        </div>
                        <div style="font-weight: bold; background:url(Alert_Image.jpg); width: 600px; height: 350px; position: relative; background-repeat: no-repeat; background-size: cover; background-position: center; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none;" id="response"></div>`;
                        $(document).ready(function()
                        {
                            $("#issuebook").submit(function(e)
                            {
                                e.preventDefault();
                                document.querySelector("#issuefield").style.display="none";
                                document.querySelector("#response").style.display="block";
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
                    
                    //return

                    document.getElementById("r").addEventListener("click",()=>
                    {
                        let hovered = document.getElementsByClassName("hovered");
                        for(let i=0;i<hovered.length;i++)
                        {
                            hovered[i].style.color="#61908a";
                            hovered[i].style.backgroundColor="black";
                        }
                        document.querySelector("#r").style.color="black";
                        document.querySelector("#r").style.backgroundColor="aliceblue";
                        var container=document.getElementById("contain");
                        container.innerHTML=`
                        <div id="returnfield" style="font-weight:bold;width:600px;height:600px;position:absolute;top:50%;left:50%;translate: -50% -35%;border-radius: 5px;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
                            <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                                <form id="returnform" method="post" action="" autocomplete="off">
                                    <center>
                                        <h1>Book Return Form</h1>
                                        <label>Member Type:</label><br>
                                        <label class="form-check-label">Student:</label>&nbsp;&nbsp;<input type="radio" name="membertype" checked class="form-check-input bg-dark" value="Student"/>
                                        <label class="form-check-label">Faculty:</label>&nbsp;&nbsp;<input type="radio" name="membertype" class="form-check-input bg-dark" value="Faculty"/><br><br>
                                        <label>Member ID:</label>
                                        <input required type="text" name="memberid" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Member ID"/><br>

                                        <label>Book Number:</label>
                                        <input required type="text" name="bookno" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Book No."/><br>

                                        <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Return"/>
                                        <button type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                                    </center>
                                </form>
                            </div>
                        </div>
                        <div style="font-weight: bold; background:url(Alert_Image.jpg); width: 600px; height: 350px; position: relative; background-repeat: no-repeat; background-size: cover; background-position: center; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none;" id="response2"></div>`;
                        $(document).ready(function()
                        {
                            $("#returnform").submit(function(e)
                            {
                                document.querySelector("#returnfield").style.display="none";
                                document.querySelector("#response2").style.display="block";
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

                    //audit

                    document.getElementById("au").addEventListener("click",()=>{
                        let hovered = document.getElementsByClassName("hovered");
                        for(let i=0;i<hovered.length;i++)
                        {
                            hovered[i].style.color="#61908a";
                            hovered[i].style.backgroundColor="black";
                        }
                        document.querySelector("#au").style.color="black";
                        document.querySelector("#au").style.backgroundColor="aliceblue";
                        var container=document.getElementById("contain");
                        container.innerHTML=`
                        <div id="aufield" style="font-weight:bold;width:600px;height:600px;position:absolute;top:50%;left:50%;translate: -50% -35%;border-radius: 5px;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
                            <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                                <form id="auform" method="post" action="" autocomplete="off">
                                    <center>
                                        <h1>Audit Form</h1>
                                        <label>Member Type:</label><br>
                                        <label class="form-check-label">Student:</label>&nbsp;&nbsp;<input type="radio" name="membertype" checked class="form-check-input bg-dark" value="Student"/>
                                        &nbsp;
                                        <label class="form-check-label">Faculty:</label>&nbsp;&nbsp;<input type="radio" name="membertype" class="form-check-input bg-dark" value="Faculty"/>
                                        &nbsp;
                                        <label class="form-check-label">All:</label>&nbsp;&nbsp;<input type="radio" name="membertype" checked class="form-check-input bg-dark" value="All"/>
                                        <br><br>
                                        <label>To:</label>
                                        <input required type="date" name="to" class="form-control bg-dark" style="width:100%;color:aliceblue;" /><br>                                    
                                        <label>From:</label>
                                        <input required type="date" name="from" class="form-control bg-dark" style="width:100%;color:aliceblue;" /><br>
                                        <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Search"/>
                                        <button type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                                    </center>
                                </form>
                            </div>
                        </div>
                        <div style="font-weight: bold; background:url(Alert_Image.jpg); width: 600px; height: 350px; position: relative; background-repeat: no-repeat; background-size: cover; background-position: center; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none;" id="response7"></div>`;
                        $(document).ready(function()
                        {
                            $("#auform").submit(function(e)
                            {
                                document.querySelector("#aufield").style.display="none";
                                document.querySelector("#response7").style.display="block";
                                e.preventDefault();
                                $.ajax(
                                {
                                    method: "post",
                                    url: "Audit.php",
                                    data: $(this).serialize(),
                                    datatype: "text",
                                    success: function(Result)
                                    {
                                        $("#response7").html(Result);
                                    }
                                });
                            });
                        });
                    });

                    //membership

                    document.getElementById("me").addEventListener("click",()=>
                    {
                        let hovered = document.getElementsByClassName("hovered");
                        for(let i=0;i<hovered.length;i++)
                        {
                            hovered[i].style.color="#61908a";
                            hovered[i].style.backgroundColor="black";
                        }
                        document.querySelector("#me").style.color="black";
                        document.querySelector("#me").style.backgroundColor="aliceblue";
                        var container=document.getElementById("contain");
                        container.innerHTML=`
                        <div id="mefield" style="font-weight:bold;width:600px;height:600px;position:absolute;top:50%;left:50%;translate: -50% -35%;border-radius: 5px;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
                            <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                                <form id="meform" method="post" action="" autocomplete="off">
                                    <center>
                                    <h1>Add Member Form</h1>
                                    <label>Course:</label>
                                    <select name="course1" id="mb" class="form-control bg-dark" style="width:100%;color:aliceblue;">
                                            <option value="IT">MTech(IT) 5yrs</option>
                                            <option value="IC">MCA 5yrs</option>
                                            <option value="IB">B.com(H)</option>
                                            <option value="TA">MBA(T) 2yrs</option>
                                            <option value="TM">MBA(TM) 5yrs</option>
                                            <option value="FT">MBA(MS) 2yrs</option>
                                            <option value="IM">MBA(MS) 5yrs</option>
                                            <option value="AP">MBA(APR)</option>
                                            <option value="ES">MBA(E-SHIP)</option>
                                        </select><br>
                                        <label>Year:</label>
                                        <input required type="number" name="year" maxlength="4" class="form-control bg-dark" style="width:100%;color:aliceblue;" /><br>
                                        <label>Serial No:</label>
                                        <input required type="text" name="Serial No" class="form-control bg-dark" style="width:100%;color:aliceblue;" /><br>
                                        <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Add"/>
                                        <button type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                                        <div style="color:red;font-weight: bold;" id="response_me"></div>
                                    </center>
                                </form>
                            </div>
                        </div>
                        <div style="font-weight: bold; background:url(Alert_Image.jpg); width: 600px; height: 350px; position: relative; background-repeat: no-repeat; background-size: cover; background-position: center; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none;" id="response8"></div>`;
                        $(document).ready(function()
                        {
                            $("#meform").submit(function(e)
                            {
                                document.querySelector("#mefield").style.display="none";
                                document.querySelector("#response8").style.display="block";
                                e.preventDefault();
                                $.ajax(
                                {
                                    method: "post",
                                    url: "Membership.php",
                                    data: $(this).serialize(),
                                    datatype: "text",
                                    success: function(Result)
                                    {
                                        $("#response8").html(Result);
                                    }
                                });
                            });
                        });
                    })

                    //insert

                    document.getElementById("ins").addEventListener("click",()=>
                    {
                        let hovered = document.getElementsByClassName("hovered");
                        for(let i=0;i<hovered.length;i++)
                        {
                            hovered[i].style.color="#61908a";
                            hovered[i].style.backgroundColor="black";
                        }
                        document.querySelector("#ins").style.color="black";
                        document.querySelector("#ins").style.backgroundColor="aliceblue";
                        var container=document.getElementById("contain");
                        container.innerHTML=`
                        <div id="InsertField" style="font-weight:bold;width:600px;height:600px;position:absolute;top:50%;left:50%;translate: -50% -35%;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
                            <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                                <form id="insertform" method="post" action="" autocomplete="off">
                                    <center>
                                        <h1>Book Insert Form</h1>
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Book Number:</label>
                                                <input required type="text" name="bookno" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Book No."/>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Title:</label>
                                                <input required type="text" name="title" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Edition:</label>
                                                <input required type="text" name="edition" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Author 1:</label>
                                                <input required type="text" name="author1" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Author 2:</label>
                                                <input type="text" name="author2" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Author 3:</label>
                                                <input type="text" name="author3" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Publisher:</label>
                                                <input required type="text" name="publisher" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Supplier:</label>
                                                <input type="text" name="supplier" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Cost:</label>
                                                <input type="number" name="cost" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>Total Pages:</label>
                                                <input required type="number" name="totalpages" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>No. of Copy:</label>
                                                <input type="number" name="bookcount" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                                                <label>CL No.</label>
                                                <input required type="number" name="CL" class="form-control bg-dark" step="0.0000001" style="width:100%;color:aliceblue;"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                                                <label>Bill Number:</label>
                                                <input type="text" name="billno" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                            </div>
                                        </div><br>
                                        <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Insert"/>
                                        <button type="reset" class="btn" style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                                        </center>
                                        </form>
                            </div>
                        </div>
                        <div style="font-weight: bold; background:url(Alert_Image.jpg); width: 600px; height: 350px; position: relative; background-repeat: no-repeat; background-size: cover; background-position: center; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none;" id="response3"></div>`;
                        $(document).ready(function()
                        {
                            $("#insertform").submit(function(e)
                            {
                                e.preventDefault();
                                document.getElementById("InsertField").style.display="none";
                                document.getElementById("response3").style.display="block";
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

                    //search

                    document.getElementById("s").addEventListener("click",()=>
                    {
                        let hovered = document.getElementsByClassName("hovered");
                        for(let i=0;i<hovered.length;i++)
                        {
                            hovered[i].style.color="#61908a";
                            hovered[i].style.backgroundColor="black";
                        }
                        document.querySelector("#s").style.color="black";
                        document.querySelector("#s").style.backgroundColor="aliceblue";
                        var container=document.getElementById("contain");
                        container.innerHTML=`
                        <div id="SearchField" style="font-weight:bold;width:600px;height:600px;position:absolute;top:50%;left:50%;translate: -50% -35%;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
                            <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                                <form id="searchform" method="post" action="" autocomplete="off">
                                    <center>
                                        <h1>Book Search Form</h1>
                                        <label>Category:</label>
                                        <select id="sb" name="soption" class="form-control bg-dark" style="width:100%;color:aliceblue;">
                                            <option value="Book No.">Book No.</option>
                                            <option value="Author">Author</option>
                                            <option value="Title">Title</option>
                                        </select><br>
                                        <div id="searchcontain"></div><br>
                                        <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Search"/>
                                        <button id="resetsearch" type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                                    </center>
                                </form>
                            </div>
                        </div>
                        <div style="font-weight: bold; background:url(Alert_Image.jpg); width: 600px; height: 350px; position: relative; background-repeat: no-repeat; background-size: cover; background-position: center; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none;" id="response3"></div>`;
                        $(document).ready(function()
                        {
                            var sb=document.getElementById("sb");
                            var sval=sb.options[sb.selectedIndex].value;
                            var sc=document.getElementById("searchcontain");
                            if(sval=="Book No.")
                            {
                                sc.innerHTML=`<label>Book Number:</label><input required type="text" name="bookno" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Book No."/>`;
                            }
                            $("#sb").click(function()
                            {
                                var sb=document.getElementById("sb");
                                var sval=sb.options[sb.selectedIndex].value;
                                var sc=document.getElementById("searchcontain");
                                if(sval=="Book No.")
                                {
                                    sc.innerHTML=`<label>Book Number:</label><input required type="text" name="bookno" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Book No."/>`;
                                }
                                if(sval=="Author")
                                {
                                    sc.innerHTML=`<label>Author:</label><input required type="text" name="author" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>`;
                                }
                                if(sval=="Title")
                                {
                                    sc.innerHTML=`<label>Title:</label><input required type="text" name="title" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>`;
                                }
                            });
                            $("#resetsearch").click(function()
                            {
                                document.getElementById("searchcontain").innerHTML="<label>Book Number:</label><input required type='text' name='bookno' class='form-control bg-dark' style='width:100%;color:aliceblue;' placeholder='Scan the Barcode or Enter Book No.'/>";
                            });
                            $("#searchform").submit(function(e)
                            {
                                e.preventDefault();
                                document.getElementById("SearchField").style.display="none";
                                document.getElementById("response3").style.display="block";
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
                    
                    //member

                    document.getElementById("m").addEventListener("click",()=>
                    {
                        let hovered = document.getElementsByClassName("hovered");
                        for(let i=0;i<hovered.length;i++)
                        {
                            hovered[i].style.color="#61908a";
                            hovered[i].style.backgroundColor="black";
                        }
                        document.querySelector("#m").style.color="black";
                        document.querySelector("#m").style.backgroundColor="aliceblue";
                        var container=document.getElementById("contain");
                        container.innerHTML=`
                        <div id="memberfield" style="font-weight:bold;width:600px;height:600px;position:absolute;top:50%;left:50%;translate: -50% -35%;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
                            <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                                <form id="memberform" method="post" action="" autocomplete="off">
                                    <center>
                                        <h1>Book Member Form</h1>
                                        <label>Check Dues:</label>
                                        <select name="moption" id="mb" class="form-control bg-dark" style="width:100%;color:aliceblue;">
                                            <option value="Single Member">Single Member</option>
                                            <option value="Class">Class</option>
                                        </select><br>
                                        <div id="membercontain"></div>
                                        <input id="membersubmit" type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Check"/>
                                        <button type="reset" id="resetmember" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button>                                        
                                    </center>
                                </form>
                            </div>
                        </div>
                        <div style="font-weight: bold; background:url(Alert_Image.jpg); width: 600px; height: 350px; position: relative; background-repeat: no-repeat; background-size: cover; background-position: center; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none;" id="response6"></div>`;
                        $(document).ready(function()
                        {

                            var mb=document.getElementById("mb");
                            var mval=mb.options[mb.selectedIndex].value;
                            var mc=document.getElementById("membercontain");
                            if(mval=="Single Member")
                            {
                                mc.innerHTML=`<label>Member ID:</label><input required type="text" name="memberid" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                <br>`;
                                document.getElementById("membersubmit").setAttribute("value","Check");
                            }
                            $("#mb").click(function()
                            {
                                var mb=document.getElementById("mb");
                                var mval=mb.options[mb.selectedIndex].value;
                                var mc=document.getElementById("membercontain");
                                if(mval=="Single Member")
                                {
                                    mc.innerHTML=`<label>Member ID:</label><input required type="text" name="memberid" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                    <br>`;
                                    document.getElementById("membersubmit").setAttribute("value","Check");
                                }
                                if(mval=="Class")
                                {
                                    mc.innerHTML=`<label>Course:</label>
                                    <select name="course" id="mb" class="form-control bg-dark" style="width:100%;color:aliceblue;">
                                            <option value="IT">MTech(IT) 5yrs</option>
                                            <option value="IC">MCA 5yrs</option>
                                            <option value="IB">B.com(H)</option>
                                            <option value="TA">MBA(T) 2yrs</option>
                                            <option value="TM">MBA(TM) 5yrs</option>
                                            <option value="FT">MBA(MS) 2yrs</option>
                                            <option value="IM">MBA(MS) 5yrs</option>
                                            <option value="AP">MBA(APR)</option>
                                            <option value="ES">MBA(E-SHIP)</option>
                                        </select><br>
                                    <label>Year:</label><input required type="number" name="year" maxlength="4" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                                    <br>`;
                                    document.getElementById("membersubmit").setAttribute("value","Download");
                                }
                            });

                            $("#resetmember").click(function()
                            {
                                document.getElementById("membercontain").innerHTML='<label>Member ID:</label><input required type="text" name="memberid" class="form-control bg-dark" style="width:100%;color:aliceblue;"/><br>';
                                document.getElementById("membersubmit").setAttribute("value","Check");
                            });

                            $("#memberform").submit(function(e)
                            {
                                e.preventDefault();
                                document.getElementById("memberfield").style.display="none";
                                document.getElementById("response6").style.display="block";
                                if(document.getElementById("membersubmit").value==="Download")
                                {
                                    document.getElementById("memberfield").style.display="block";
                                    document.getElementById("response6").style.display="none";
                                }
                                $.ajax(
                                {
                                    method: "post",
                                    url: "Member.php",
                                    data: $(this).serialize(),
                                    datatype: "text",
                                    success: function(Result)
                                    {
                                        $("#response6").html(Result);
                                    }
                                });
                            });
                        });
                    });

                    //logout

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
                    let s=0;
                    let interval=setInterval(frame,1000);
                    function frame()
                    {
                        if(s===600)
                        {
                            window.location.reload();
                        }
                        document.addEventListener('mousemove',()=>
                        {
                            s=0;
                        });
                        document.addEventListener('keydown',()=>
                        {
                            s=0;
                        });
                        s++;
                    }
                </script>
            </html>
    <?php
}
?>