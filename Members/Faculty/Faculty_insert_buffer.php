<?php
    include "../../connection/dbconnect.php";

    $stat="select val1,val2,val3 from `insert buffer`;";
    $result=$conn->query($stat);
    
    if($result)
    {
        while($row= $result->fetch_array())
        {
            $sArray[]=$row;
        }
        
        for($i=0;$i<count($sArray);$i++)
        {
            $fcaId=$sArray[$i][0];
            $fcaId=strtoupper($fcaId);
            $fcaId=str_replace("-","",$fcaId);
            $fName=$sArray[$i][1];
            $fType=$sArray[$i][2];

            $stat1="insert into faculty(Faculty_ID,Faculty_Name,Faculty_Type) values ('$fcaId','$fName','$fType');";
            $res=$conn->query($stat1);
            if($res)
            {
                // echo"
                // <div id='dialog_student_excel' style='color:green;' title='Succesfull'>
                //     <p><center>Data Inserted Successfully</center></p>
                // </div>;
                // ";
                $sql_delete = "DELETE from `insert buffer`;";
                $result=$conn->query($sql_delete);
            }
            else
            {
                echo"error";
            }
        }
    }

?>