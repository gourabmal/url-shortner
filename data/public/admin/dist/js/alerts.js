function printSuccess(msg) {
    document.getElementById('message_print').innerHTML =
        '<div class="alert alert-success" role="alert">' +
        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
        '<strong>Success!</strong> ' + msg + '</div>';
}

function printError(msg) {
    document.getElementById('message_print').innerHTML =
        '<div class="alert alert-danger" role="alert">' +
        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
        '<strong>Error!</strong> ' + msg + '</div>';
}

function printValidationError(msg)
{
    $.each(msg, function (key, value) {
        document.getElementById(key+ '_err').innerHTML = value;
    });
}