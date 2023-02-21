<?php
include "dbconnect.php";
class search
{
    private $sql,$conn;

    function __construct($conn,$sql)
    {   
        $this->conn=$conn;
        $this->sql=$sql;
    }

    public function disp()
    {
        $search=$this->conn->query($this->sql);
        echo"
        <table class='table table-striped table-responsive table-hover table-bordered'>
        <tr>
        <th style='text-align:center;'>Book No.</th>
        <th style='text-align:center;'>Author</th>
        <th style='text-align:center;'>Title</th>
        <th style='text-align:center;'>Edition</th>
        <th style='text-align:center;'>Publisher</th>
        <th style='text-align:center;'>Total Pages</th>
        <th style='text-align:center;'>Cost</th>
        <th style='text-align:center;'>Supplier</th>
        <th style='text-align:center;'>Bill No.</th>
        <th style='text-align:center;'>Delete</th>
        </tr>";
        $i=1;
        while($row=$search->fetch_assoc())
        {
            echo"
            <tr>
            <td style='text-align:center;'>".$row["Book_No"]."</td>
            <td style='text-align:center;'>".$row["Author"]."</td>
            <td style='text-align:center;'>".$row["Title"]."</td>
            <td style='text-align:center;'>".$row["Edition"]."</td>
            <td style='text-align:center;'>".$row["Publisher"]."</td>
            <td style='text-align:center;'>".$row["Total_Pages"]."</td>
            <td style='text-align:center;'>".$row["Cost"]."</td>
            <td style='text-align:center;'>".$row["Supplier"]."</td>
            <td style='text-align:center;'>".$row["Bill_No"]."</td>
            <td style='text-align:center;'><form id='del$i' method='post' action=''>
            <div style='display:none;'><input type='radio' value='".$row["Book_No"]."' name='bookno' checked>
            <input type='radio' value='".$row["Title"]."' checked name='title'></div>
            <input type='submit' value='Delete' class='btn btn-danger'>
            </form>
            </td>
            </tr>
            <script>
            $(document).ready(function()
            {
                $('#del$i').submit(function(e)
                {
                    e.preventDefault();
                    $.ajax(
                    {
                        method: 'post',
                        url: 'delete.php',
                        data: $(this).serialize(),
                        datatype: 'text',
                        success: function(Result)
                        {
                            $('#deleted').html(Result);
                        }
                    });
                });
            });
            </script>";
            $i++;
        }
        echo"</table>";
    }
}

if(!empty(filter_input(INPUT_POST,"column")) && !empty($_POST["data"]))
{
    $column=filter_input(INPUT_POST,"column");
    if($column=="Book No.") $column="Book_No";
    if($column=="Total Pages") $column="Total_Pages";
    if($column=="Bill No.") $column="Bill_No";
    $data=$_POST["data"];
    $sql="SELECT * from books where $column = '$data';";
    $s1=new search($conn,$sql);
    $s1->disp();
}
else
{
    echo"<center><div style='color:red;font-weight:bolder;'>Data not inserted!!!</div></center";
}
?>