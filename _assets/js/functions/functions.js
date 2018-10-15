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
        config.html = texto;
    }
    if (texto_botao != undefined || texto_botao != null) {
        config.confirmButtonText = texto_botao;
    }

    swal(config);
}

function alertClose() {
    swal.close();
}

$.fn.serializeObject = function() {
    limparPlaceHolder();
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    carregarPlaceHolder();
    return o;
};

/*********************** Compatibilidade com IE 8 *****************************/
// coloca placeholder nos campos que o browser não puder colocar nativo
function carregarPlaceHolder() {
    if (!$.support.placeholder) {
        $('[placeholder]').each(function() {
            var input = $(this);
            if ($(input).val() == '')
                $(input).val(input.attr('placeholder'));
            $(input).focus(function() {
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                }
            });
            $(input).blur(function() {
                if (input.val() == '' || input.val() == input.attr('placeholder')) {
                    input.val(input.attr('placeholder'));
                }
            });
        });
    }
}

// retira o placeholder dos campos para poder pegar os valores dos inputs e não os placeholders dos mesmos.
function limparPlaceHolder() {
    if (!$.support.placeholder) {
        $('[placeholder]').each(function() {
            var input = $(this);
            if (input.val() == input.attr('placeholder'))
                input.val('');
        });
    }
}

function maskTel(obj) {
    var SPMaskBehavior = function(val) {
            return val.replace(/\D/g, '').length === 11 ? '(99) 99999-9999' : '(99) 9999-99990';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

    $(obj).mask(SPMaskBehavior, spOptions);
}

function maskCPFCNPJ(obj) {
    var CMaskBehavior = function(val) {
            var mask = '0#';
            var attr = '';
            var size = val.replace(/\D/g, '').length;
            if (size == 11) {
                mask = '000.000.000-00#';
                attr = 'cpf';
            } else if (size == 14) {
                mask = '00.000.000/0000-00';
                attr = 'cnpj';
            }

            $(obj).attr('data-tipo', attr).trigger('change');

            return mask;
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(CMaskBehavior.apply({}, arguments), options);
            }
        };

    $(obj).mask(CMaskBehavior, spOptions);
}