function handleError() {
    alert('Some Error Occurred!!!');
}

function handleSuccess(Result) {
    $("#dialog4").dialog("destroy");
    $("#response4").html(Result);
    $("#dialog4").dialog();
}

function setupAjax() {
    $.ajax({
        // ...existing code...
        error: handleError,
        success: handleSuccess
    });
}

$(document).ready(function() {
    setupAjax();
});