$(document).ready(function() {
    // LOGIN
    $('form#login').submit(function() {
        var formData = $(this).serializeObject();
        $.gApi.exec('POST', 'login.php', formData,
            function(retorno) {
                swal.close();
            },
            function(retorno) {
                swal.close();
            });
        return false;
    });
});