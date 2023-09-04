<?php



function show_table()
{
    include "dbconnect.php";
    $stat="SELECT * FROM admin;";
    $result=$conn->query($stat);
    if($result && mysqli_num_rows($result) > 0)
    {
        echo "
        <div style='width:100%;height:650px;overflow:auto;'><table>
        <tr>
        <th>User ID</th>
        <th>User Level</th>
        <th>Delete</th>
        </tr>
        <tbody>";
        $count=1;
        
        while($row=$result->fetch_assoc())
        {
            echo"
            <tr>
            <td>".$row["Username"]."</td>
            <td>".$row["User_level"]."</td>
            <td>
                <form action='' id='delete$count' method='post'>
                    <button type='submit' class='btn btn-danger'>Delete</button></td>
                </form>
                <script>
                    $(document).ready(function(){
                        $('#delete$count').submit(function(p){
                            p.preventDefault();
                            $.ajax(
                                {
                                    method:'post',
                                    url:'delete_user.php',
                                    data:$(this).serialize(),
                                    datatype:'text',
                                    success:function(p2){
                                        $( '#dialog_admin_disp' ).dialog( 'destroy' );
                                        $('#admin_info').html(p2);
                                        $('#dialog_admin_disp').dialog(); 
                                         
                                        
                                    }
                                }
                            );
                        });    
                    });
                </script>
            </tr>
            ";
            $count++;
        }
        echo "</tbody>
        </table></div>
        <script>

            document.getElementById('display').style.transform='translate(-120%,-50%)';
            document.getElementById('response_admin_disp').style.transform='translate(170%,-89%)';
        </script>";
    }
    else
    {
        echo "
        <div id='dialog_admin_disp' style='color:red;' title='⚠️Error'>
            <p><center>$conn->error</center></p>
        </div>
        "; 
    }

}
show_table();



?>