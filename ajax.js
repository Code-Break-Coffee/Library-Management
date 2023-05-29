$(document).ready(function()
{
    $("#issueform").submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            method: "post",
            url: "Issue.php",
            data: $(this).serialize(),
            datatype: "text",
            success: function(Result)
            {
                $("#response").html(Result);
            }
        });
    });
    $("#returnform").submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            method : "post",
            url: "Return.php",
            data: $(this).serialize(),
            datatype: "text",
            success: function(Result)
            {
                $("#response2").html(Result);
            }
        });
    });
    $("#delete_").submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            method: "post",
            url: "temp.js",
            data: $(this).serialize(),
            datatype: "text",
            success: function(Result)
            {
                $("response4").html(Result);
            }
        });
    });
});