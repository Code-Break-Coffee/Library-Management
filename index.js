//-------login--------//
$(document).ready(function()
{
    $("#login").submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            method: "post",
            url: "Login.php",
            data: $(this).serialize() + "&Access=" +"Index-Login",
            datatype: "text",
            success: function(Result)
            {
                document.getElementById("Student").style.display="none";
                document.getElementById("logout").style.display="block";
                $("#contain").html(Result);
            }
        });
    });
});