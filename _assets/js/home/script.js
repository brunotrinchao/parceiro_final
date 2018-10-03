$(document).ready(function() {
    // LOGIN
    $('form#login').submit(function() {
        var formData = $(this).serializeObject();
        $.gApi.exec('POST', 'login.php', formData,
            function(retorno) {
                console.log(retorno);
            },
            function(retorno) {
                console.log(retorno);
            });
        return false;
    });
});