 <?php
    include "dbconnect.php";

    $member;
    $sql;
    $result;
    if(!empty(filter_input(INPUT_POST,"member")))
    {
        $member=filter_input(INPUT_POST,"member");
        if($member=="Student")
        {
            $sql="SELECT * from student;";
            $result=$conn->query($sql);
            if($result)
            {
                echo "<table class='table table-responsive table-striped table-bordered table-hover'>
                <tr class='table-info'>
                <th style='text-align:center;'>Roll No.</th>
                <th style='text-align:center;'>Name</th>
                <th style='text-align:center;'>Course</th>
                <th style='text-align:center;'>Enrollment No.</th>
                <th style='text-align:center;'>Book 1</th>
                <th style='text-align:center;'>Book 2</th>
                <th style='text-align:center;'>Book 3</th>
                </tr>";
                while($row=$result->fetch_assoc())
                {
                    echo"<tr>
                    <td style='text-align:center;'>".$row["Student_Rollno"]."</td>
                    <td style='text-align:center;'>".$row["Student_Name"]."</td>
                    <td style='text-align:center;'>".$row["Student_Course"]."</td>
                    <td style='text-align:center;'>".$row["Student_Enrollmentno"]."</td>
                    <td style='text-align:center;'>".$row["Student_Book1"]."</td>
                    <td style='text-align:center;'>".$row["Student_Book2"]."</td>
                    <td style='text-align:center;'>".$row["Student_Book3"]."</td>
                    </tr>";
                }
                echo"</table>";
            }
            else echo $conn->error;
        }
        else if($member == "Faculty")
        {
            $sql="SELECT * from faculty;";
            $result=$conn->query($sql);
            if($result)
            {
                echo "<table class='table table-responsive table-striped table-bordered table-hover'>
                <tr class='table-info'>
                <th style='text-align:center;'>ID</th>
                <th style='text-align:center;'>Name</th>
                <th style='text-align:center;'>Type</th>
                <th style='text-align:center;'>Father or Husband</th>
                <th style='text-align:center;'>Book 1</th>
                <th style='text-align:center;'>Book 2</th>
                <th style='text-align:center;'>Book 3</th>
                <th style='text-align:center;'>Book 4</th>
                <th style='text-align:center;'>Book 5</th>
                </tr>";
                while($row=$result->fetch_assoc())
                {
                    echo"<tr>
                    <td style='text-align:center;'>".$row["Faculty_ID"]."</td>
                    <td style='text-align:center;'>".$row["Faculty_Name"]."</td>
                    <td style='text-align:center;'>".$row["Faculty_Type"]."</td>
                    <td style='text-align:center;'>".$row["Faculty_Fatherorhusband"]."</td>
                    <td style='text-align:center;'>".$row["Faculty_Book1"]."</td>
                    <td style='text-align:center;'>".$row["Faculty_Book2"]."</td>
                    <td style='text-align:center;'>".$row["Faculty_Book3"]."</td>
                    <td style='text-align:center;'>".$row["Faculty_Book4"]."</td>
                    <td style='text-align:center;'>".$row["Faculty_Book5"]."</td>
                    </tr>";
                }
                echo"</table>";
            }
        }
    }
    else echo "<script>window.alert('No Input Given!!!')</script>";
 ?>