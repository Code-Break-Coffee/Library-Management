document.getElementById("author").addEventListener('focus',()=>
{
    let holder=document.getElementById("holder");
    holder.setAttribute("placeholder","Enter the Author:");
});
document.getElementById("title").addEventListener('focus',()=>
{
    let holder=document.getElementById("holder");
    holder.setAttribute("placeholder","Enter the Title:");
});

$(document).ready(function()
{
    $("#studentSearch").submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            method: "post",
            url: "student.php",
            data: $(this).serialize(),
            datatype: "text",
            success: function(Response)
            {
                document.getElementById("iframeblock").style.display="block";
                document.getElementById("formblock").style.transform="translate(-180%,-60%)";
                $("#iframeblock").html(Response);
            }
        });
    });
});

function cleared()
{
    let holder=document.getElementById("holder");
    document.getElementById("iframeblock").style.display="none";
    document.getElementById("formblock").style.transform="translate(-50%,-60%)";
    holder.value="";
    document.getElementById("clear2").style.display="none";
}