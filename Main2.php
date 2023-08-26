<?php
@session_start();
if(empty($_SESSION["username"]) || $_SESSION["File"] != "Index.php")
{
    header("Location: /LibraryManagement/index.php");
}
else
{
    $_SESSION["File"] = "Main2.php";
    $_SESSION["TEMP"] = "987";
    ?>
                    <!--navbar-->
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
                                    <li class="nav-item">
                                        <a class="nav-link hovered" id="admin_panel">Administrator</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div id="container"></div>
                    <script src="./jquery-ui-1.13.2.custom/jquery-ui.js"></script>
                    <script src="Main.js"></script>
    <?php
}
?>