<?php

$mem_id = $_POST["memberid"];
$mem_type = $_POST["membertype"];
$sql_m = "SELECT * from member;";
$result_m = $conn->query($sql_m);
$check_status = TRUE;
$count = 0;
if($result_m)
{
    while($row = $result_m -> fetch_assoc())
    {
        if($row["Member_ID"] == $m)
        {
            if($row["Book_Issue1"] != null)
            {
                $check_status = FALSE;
                $count++;
                break;
            }
            else if($row["Book_Issue2"] != null)
            {
                $check_status = FALSE;
                $count++;
                break;
            }
            else if($row["Book_Issue3"] != null)
            {
                $check_status = FALSE;
                $count++;
                break;
            }
            else if($row["Book_Issue4"] != null)
            {
                $check_status = FALSE;
                $count++;
                break;
            }
            else if($row["Book_Issue5"] != null)
            {
                $check_status = FALSE;
                $count++;
                break;
            }
            else if($row["Book_Issue6"] != null)
            {
                $check_status = FALSE;
                $count++;
                break;
            }
            else if($row["Book_Issue7"] != null)
            {
                $check_status = FALSE;
                $count++;
                break;
            }
            else if($row["Book_Issue8"] != null)
            {
                $check_status = FALSE;
                $count++;
                break;
            }
            else if($row["Book_Issue9"] != null)
            {
                $check_status = FALSE;
                $count++;
                break;
            }
            else if($row["Book_Issue10"] != null)
            {
                $check_status = FALSE;
                $count++;
                break;
            }
        }
    }

    if(!$check_status)
    {
        echo "Book issued.";
        echo "Number of books issued: $count";
    }

}
else
{
    echo "Member not found.";
}


?>