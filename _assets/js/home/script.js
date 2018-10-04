$(document).ready(function() {
    // LOGIN
    $('form#login').submit(function() {
        var formData = $(this).serializeObject();
        $.gApi.exec('POST', 'login.php', formData,
            function(retorno) {
                window.location.reload();
            },
            function(retorno) {
                swal.close();
            });
        return false;
    });
});