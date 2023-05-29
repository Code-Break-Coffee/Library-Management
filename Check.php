<?php
function bookcheck($x,$y)
{
    if($x)
    {
        while($row=$x->fetch_assoc())
        {
            if($row["Book_No"] == $y && $row["Status"] == "Available")
            {
                return true;
            }
        }
    }
    return false;
}

function membercheck($x,$y)
{
    if($x)
    {
        while($row=$x->fetch_assoc())
        {
            if($row["Member_ID"] == $y)
            {
                return true;
            }
        }
    }
    return false;
}
function memberTypeCheck($x,$y,$z)
{
    if($x && $z =="Student")
    {
        while($row=$x->fetch_assoc())
        {
            if($row["Student_Rollno"] == $y)
            {
                return true;
            }
        }
    }
    else if($x && $z == "Faculty")
    {
        while($row=$x->fetch_assoc())
        {
            if($row["Faculty_ID"] == $y)
            {
                return true;
            }
        }
    }
    return false;
}