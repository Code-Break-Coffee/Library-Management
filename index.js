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

// window.addEventListener("beforeunload",(e)=>
// {
//     e.preventDefault();
//     if(performance.navigation.type!=performance.navigation.TYPE_RELOAD)
//     {
//         $.ajax(
//         {
//             method: "post",
//             url: "Logout.php",
//         });
//     }
// });