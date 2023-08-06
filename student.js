let holder=document.getElementById("holder");
document.getElementById("author").addEventListener('focus',()=>
{
    holder.setAttribute("placeholder","Enter the Author:");
});
document.getElementById("title").addEventListener('focus',()=>
{
    holder.setAttribute("placeholder","Enter the Title:");
});

$(document).ready(function()
{
    $("#studentSearch").submit(function(e)
    {
        e.preventDefault();
        document.getElementById("formblock").style.display="none";
        document.getElementById("iframeblock").style.display="block";
        $.ajax(
        {
            method: "post",
            url: "student.php",
            data: $(this).serialize(),
            datatype: "text",
            success: function(Response)
            {

            }
        });
    });
});