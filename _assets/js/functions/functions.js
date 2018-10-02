// FUNÇOES DE ALERT

/**
 *
 * @param {*} titulo
 * @param {*} texto
 * @param {*} tipo - error, success, warning, info, question
 * @param {*} texto_botao
 */
function alerta(titulo, texto, tipo, texto_botao) {
    var config = {};
    var _tipo = (tipo == undefined || tipo == null) ? 'error' : tipo;
    var _titulo = (_tipo == 'error') ? 'Erro' : (_tipo == 'success') ? 'Sucesso' : (_tipo == 'warning') ? 'Atenção' : titulo;

    config.title = _titulo;
    config.type = _tipo;
    if (texto != undefined || texto != null) {
        config.text = texto;
    }
    if (texto_botao != undefined || texto_botao != null) {
        config.confirmButtonText = texto_botao;
    }

    swal(config);
}

function alertClose() {
    swal.close();
}

// MENU