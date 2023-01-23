$(document).ready(function()
{
    $("#insert_book").submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            method: "post",
            url: "insertion.php",
            data: $(this).serialize(),
            datatype: "text",
            success: function(Result)
            {
                $("#response").html(Result);
            }
        });
    });
});