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

$(document).ready(function(){
    $("#book_s").autocomplete({
        autoFocus: true,
        source: "Suggestions.php",
    });
});

function cleared()
{
    let holder=document.getElementById("book_s");
    document.getElementById("iframeblock").style.display="none";
    document.getElementById("formblock").style.transform="translate(-50%,-60%)";
    holder.value="";
    document.getElementById("clear2").style.display="none";
}