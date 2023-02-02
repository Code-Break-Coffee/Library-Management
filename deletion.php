<?php
include "dbconnect.php";

include "book.html";
class disp
{
    private $sql,$conn;

    function __construct($conn,$sql)
    {
        $this->conn=$conn;
        $this->sql=$sql;
    }

    public function dis()
    {
        $result=$this->conn->query($this->sql);
        if($result)
        {
            echo"
            <div id=booktable>
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
            while($row=$result->fetch_assoc())
            {
                echo"
                <tr>
                <td style='text-align:center;'>".$row["Book_No"]."</td>
                <td style='text-align:center;'>".$row["Authors"]."</td>
                <td style='text-align:center;'>".$row["Title"]."</td>
                <td style='text-align:center;'>".$row["Edition"]."</td>
                <td style='text-align:center;'>".$row["Publisher"]."</td>
                <td style='text-align:center;'>".$row["Total_Pages"]."</td>
                <td style='text-align:center;'>".$row["Cost"]."</td>
                <td style='text-align:center;'>".$row["Name_of_supplier"]."</td>
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
            echo"</table></div>";
        }
    }
}

$sql="SELECT * from books;";
$disp1=new disp($conn,$sql);
$disp1->dis();
?>