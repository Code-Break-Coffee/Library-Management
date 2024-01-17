<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
include "../../connection/dbconnect.php";
if($_POST["Access"]!="Main-Issue-Limit" || !verification())
{
    header("Location: /LibraryManagement/");
}
else
{
    if(!empty($_POST["limit"]))
    {
        $limit=$_POST["limit"];
        if($limit<=0)
        {
            echo
            "
                <div title='❌Not Allowed' id='dialog_issue_limit' style='color:red;'>
                    <p>Invalid Limit!!!</p>
                </div>
            ";
        }
        else
        {
            $sql_check="SELECT Issue_Limit from issue_limit;";
            $result_check=$conn->query($sql_check);
            if($result_check)
            {
                $row=$result_check->fetch_assoc();
                if($row["Issue_Limit"]==$limit)
                {
                    echo
                    "
                        <div title='❌Not Allowed' id='dialog_issue_limit' style='color:red;'>
                            <p>The Limit is already set to '$limit'!!!</p>
                        </div>
                    ";
                }
                else
                {
                    $sql_delete="DELETE from issue_limit;";
                    $result_delete=$conn->query($sql_delete);
                    if($result_delete)
                    {
                        $sql="INSERT into issue_limit(Issue_Limit) values($limit);";
                        $result=$conn->query($sql);
                        if($result)
                        {
                            echo
                            "
                                <div title='✅Successful' id='dialog_issue_limit' style='color:green;'>
                                    <p>Book Issue Limit changed to '$limit' books per member!!!</p>
                                </div>
                            ";
                        }
                        else
                        {
                            $result=$conn->query("INSERT into issue_limit(Issue_Limit) values(3);");
                            if($result)
                            {
                                echo
                                "
                                    <div id='dialog_issue_limit' title='⚠️Notification' style='color:red;'>
                                        <p>There was an error in changing the limit. Default limit has been changed to '3' books per member!!!</p>
                                    </div>
                                ";
                            }
                            else
                            {
                                echo
                                "
                                    <div title='❌Error' id='dialog_issue_limit' style='color:red;'>
                                        <p>Fatal Error. Contact the Support(7024888951)!!!</p>
                                    </div>
                                ";
                            }
                        }
                    }
                    else
                    {
                        echo
                        "
                            <div title='❌Error' id='dialog_issue_limit' style='color:red;'>
                                <p>Fatal Error. Contact the Support!!!</p>
                            </div>
                        ";
                    }
                }
            }
            else
            {
                echo
                "
                    <div title='❌Error' id='dialog_issue_limit' style='color:red;'>
                        <p>$conn->error</p>
                    </div>
                ";
            }
        }
    }
    else if($_POST["limit"]<=0)
    {
        echo
        "
            <div title='❌Not Allowed' id='dialog_issue_limit' style='color:red;'>
                <p>Invalid Limit!!!</p>
            </div>
        ";
    }
    else
    {
        header("Location: /LibraryManagement/");
    }
}
?>