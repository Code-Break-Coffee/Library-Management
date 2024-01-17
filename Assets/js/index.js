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

document.querySelector("#Student").addEventListener('click',()=>{window.open("StudentPage\\student.html","_blank");});

let sec=0;
const x=setInterval(()=>
{
    document.addEventListener("keydown",()=>
    {
        sec=0;
    });
    document.addEventListener("mousemove",()=>
    {
        sec=0;
    });
    if(sec===300)
    {
        window.open("Auth\\Logout.php","_self");
    }
    sec++;
},1000);