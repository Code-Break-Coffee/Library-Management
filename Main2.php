<?php
if(empty($_SESSION["username"]))
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
                            border: 2px 2px solid aliceblue;
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
                            height:769px;
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
                    </style>
                    <script src="bootstrap.bundle.js"></script>
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
                    <!-- <div style="background-color: black;width:100vw;height:5px;"></div> -->
                    <div style="background-color: black;font-size: large;font-weight: bold;">
                        <nav class="navbar navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-expand-xl navbar-expand">
                            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                                <ul class="navbar-nav nav-fill w-100">
                                    <li class="nav-item">
                                        <a class="nav-link hovered" id="s">Search</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle hovered" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Reports
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item dropdown_hover" id="au">Audit</a>
                                        <a class="dropdown-item dropdown_hover" id="m">Dues/NoDues</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle hovered" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Transactions
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item dropdown_hover" id="i">Issue</a>
                                        <a class="dropdown-item dropdown_hover" id="r">Return</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle hovered" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Book Manipulation
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item dropdown_hover" id="ins">Insert</a>
                                        <a class="dropdown-item dropdown_hover" id="d">Delete</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle hovered" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Membership
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item dropdown_hover" id="me">Add Member</a>
                                        <a class="dropdown-item dropdown_hover" id="de">Delete Member</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div id="contain"></div>
                </body>
                <script src="bootstrap.bundle.js"></script>
                <script src="Jquery.js"></script>
                <script src="Main2.js"></script>
                <script src="./jquery-ui-1.13.2.custom/jquery-ui.js"></script>
            </html>
    <?php
}
?>