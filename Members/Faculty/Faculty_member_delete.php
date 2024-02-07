<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT']."/LibraryManagement/Auth/auth.php";
function delete_faculty($sql)
{
    include "../../connection/dbconnect.php";
    $result=$conn->query($sql);
    if($result)
    {
        return true;
    }
    return false;
}

function check($fId)
{
    include "../../connection/dbconnect.php";
    $sql1="SELECT Member_ID from member where Member_ID = '$fId';";
    $result1=$conn->query($sql1);
    $sql2="SELECT Faculty_ID from faculty where Faculty_ID = '$fId';";
    $result2=$conn->query($sql2);
    if($result1)
    {
        if($result2)
        {
            if(mysqli_num_rows($result1)==1 && mysqli_num_rows($result2)==1)
            {
                return true;
            }
            return false;
        }
        else echo
        "
            <div title='Error❌' id='dialog_fac_del'>
                <p>$conn->error</p>
            </div>
        ";
    }
    else echo
    "
        <div title='Error❌' id='dialog_fac_del'>
            <p>$conn->error</p>
        </div>
    ";
}

function checkIssue($fId)
{   
    include "../../connection/dbconnect.php";
    $sql="SELECT * from issue_return where Issue_By = '$fId' and Return_Date is NULL";
    $result=$conn->query($sql);
    if($result)
    {
        if(mysqli_num_rows($result)!=0)
        {
            return false;
        }
        return true;
    }
    else echo
    "
        <div title='Error❌' id='dialog_fac_del'>
            <p>$conn->error</p>
        </div>
    ";
}
if(!verification() || $_POST["Access"] != "Main-Delete-Faculty-Member" )
{
    header("Location: /LibraryManagement/");
}
else
{
    if(!empty($_POST["fac_id"]))
    {
        $Fac_Id=$_POST["fac_id"];
        if(check($Fac_Id))
        {
            if(checkIssue($Fac_Id))
            {
                if(delete_faculty("DELETE from member where Member_ID = '$Fac_Id';"))
                {
                    echo
                    "
                        <div title='Success✅' id='dialog_fac_del'>
                            <p style='color:green;'>Faculty '$Fac_Id' deleted successfully!!!</p>
                        </div>
                    ";
                }
                else
                {
                    echo
                    "
                        <div title='Error❌' id='dialog_fac_del'>
                            <p style='color:red;'>Some Error Occurred!!!</p>
                        </div>
                    ";
                }
            }
            else
            echo
            "
                <div title='Error❌' id='dialog_fac_del'>
                    <p style='color:red;'>Faculty $Fac_Id has not returned a book, so it can`t be deleted!!!</p>
                </div>
            ";
        }
        else
        echo
            "
                <div title='Error❌' id='dialog_fac_del'>
                    <p style='color:red;'>Faculty '$Fac_Id' not Found, Please check Once!!!</p>
                </div>
            ";
    }
    else header("Location: /LibraryManagement/");
}
?>