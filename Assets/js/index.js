//-------login--------//
$(document).ready(function()
{
    $("#login").submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            method: "post",
            url: "Auth\\Login.php",
            data: $(this).serialize() + "&Access=" +"Index-Login",
            datatype: "text",
            error: function()
            {
                alert('Some Error Occurred!!!');
            },
            success: function(Result)
            {
                document.getElementById("Student").style.display="none";
                document.getElementById("logout").style.display="block";
                $("#contain").html(Result);
            }
        });
    });
});

document.querySelector("#Student").addEventListener('click',()=>{window.open("StudentPage\\student.html","_blank");});