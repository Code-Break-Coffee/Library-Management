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
            success: function(Result)
            {
                document.getElementById("Student").style.display="none";
                document.getElementById("logout").style.display="block";
                $("#contain").html(Result);
            }
        });
    });
});

let s=0;
const x=setInterval(()=>
{
    document.addEventListener("keydown",()=>
    {
        s=0;
    });
    document.addEventListener("mousemove",()=>
    {
        s=0;
    });
    if(s===300)
    {
        window.open("Auth\\Logout.php","_self");
    }
    s++;
},1000);