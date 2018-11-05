(function() {
    "use strict";

    carregaTipoOperacao();
    carregaTipoUso();
    carregaMenuTopo();
    carregaTipoBem();

    // custom scrollbar

    // $("html").niceScroll({styler:"fb",cursorcolor:"#27cce4", cursorwidth: '5', cursorborderradius: '10px', background: '#424f63', spacebarenabled:false, cursorborder: '0',  zindex: '1000'});

    $(".left-side").niceScroll({
        styler: "fb",
        cursorcolor: "#27cce4",
        cursorwidth: '3',
        cursorborderradius: '10px',
        background: '#424f63',
        spacebarenabled: false,
        cursorborder: '0'
    });


    $(".left-side").getNiceScroll();
    if ($('body').hasClass('left-side-collapsed')) {
        $(".left-side").getNiceScroll().hide();
    }



    // Toggle Left Menu
    jQuery('.menu-list > a').click(function() {

        var parent = jQuery(this).parent();
        var sub = parent.find('> ul');

        if (!jQuery('body').hasClass('left-side-collapsed')) {
            if (sub.is(':visible')) {
                sub.slideUp(200, function() {
                    parent.removeClass('nav-active');
                    jQuery('.main-content').css({
                        height: ''
                    });
                    mainContentHeightAdjust();
                });
            } else {
                visibleSubMenuClose();
                parent.addClass('nav-active');
                sub.slideDown(200, function() {
                    mainContentHeightAdjust();
                });
            }
        }
        return false;
    });

    function visibleSubMenuClose() {
        jQuery('.menu-list').each(function() {
            var t = jQuery(this);
            if (t.hasClass('nav-active')) {
                t.find('> ul').slideUp(200, function() {
                    t.removeClass('nav-active');
                });
            }
        });
    }

    function mainContentHeightAdjust() {
        // Adjust main content height
        var docHeight = jQuery(document).height();
        if (docHeight > jQuery('.main-content').height())
            jQuery('.main-content').height(docHeight);
    }

    //  class add mouse hover
    jQuery('.custom-nav > li').hover(function() {
        jQuery(this).addClass('nav-hover');
    }, function() {
        jQuery(this).removeClass('nav-hover');
    });


    // Menu Toggle
    jQuery('.toggle-btn').click(function() {
        $(".left-side").getNiceScroll().hide();

        if ($('body').hasClass('left-side-collapsed')) {
            $(".left-side").getNiceScroll().hide();
        }
        var body = jQuery('body');
        var bodyposition = body.css('position');

        if (bodyposition != 'relative') {

            if (!body.hasClass('left-side-collapsed')) {
                body.addClass('left-side-collapsed');
                jQuery('.custom-nav ul').attr('style', '');

                jQuery(this).addClass('menu-collapsed');

            } else {
                body.removeClass('left-side-collapsed chat-view');
                jQuery('.custom-nav li.active ul').css({
                    display: 'block'
                });

                jQuery(this).removeClass('menu-collapsed');

            }
        } else {

            if (body.hasClass('left-side-show'))
                body.removeClass('left-side-show');
            else
                body.addClass('left-side-show');

            mainContentHeightAdjust();
        }

    });

    searchform_reposition();

    jQuery(window).resize(function() {

        if (jQuery('body').css('position') == 'relative') {

            jQuery('body').removeClass('left-side-collapsed');

        } else {

            jQuery('body').css({
                left: '',
                marginRight: ''
            });
        }

        searchform_reposition();

    });

    function searchform_reposition() {
        if (jQuery('.searchform').css('position') == 'relative') {
            jQuery('.searchform').insertBefore('.left-side-inner .logged-user');
        } else {
            jQuery('.searchform').insertBefore('.menu-right');
        }
    }

    var SPMaskBehavior = function(val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };
    $('.telefone').mask(SPMaskBehavior, spOptions);

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

            $('.cpf_cnpj').attr('data-tipo', attr).trigger('change');

            return mask;
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(CMaskBehavior.apply({}, arguments), options);
            }
        };

    $('.cpf_cnpj').mask(CMaskBehavior, spOptions);
    $('.moeda').mask('000.000.000.000.000,00', {
        reverse: true
    });

    //---------
    // Muda CPF CNPJ
    $('input[name=TipoCliente]').change(function() {
        console.log($(this).val());

        if ($(this).val() == 'PJ') {
            $('#lbl_CPF').text('CNPJ*');
            $('.cpf_cnpj').mask('00.000.000/0000-00', spOptions);
        } else if ($(this).val() == 'PF') {
            $('#lbl_CPF').text('CPF*');
            $('.cpf_cnpj').mask('000.000.000-00#', spOptions);
        }
    });

    var start = moment().startOf('month');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        $('#periodo').val(start.format('YYYY-MM-DD') + '|' + end.format('YYYY-MM-DD'));

        filtrar();

    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        maxDate: end,
        showDropdowns: true,
        ranges: {
            'Hoje': [moment(), moment()],
            'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
            'Este mês': [moment().startOf('month'), moment().endOf('month')],
            'Mês passado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            applyLabel: 'Filtrar',
            fromLabel: 'De',
            toLabel: 'Até',
            customRangeLabel: 'Selecionar período',
            daysOfWeek: ['Do', 'Se', 'Te', 'Qu', 'Qu', 'Se', 'Sa'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            firstDay: 1
        }
    }, cb);

    cb(start, end);

    $('#formNovaIndicacao').submit(function() {

        // if (tipo_cliente == undefined) {
        //     alerta('Atenção', "Ocorreu um erro. Atualize a página para tentar resolver.<br>Caso o erro persista, entre em contato com o administrado.", 'warning', null)
        //     return false;
        // }

        if ($('form').gValidate()) {
            var url = 'http://integracaogtsis.tempsite.ws/api/V1/Indicacoes/Supercredito';
            var dados = $(this).serializeObject();
            var payload = {
                "Cliente": dados.Cliente,
                "Email": dados.Email,
                "Telefone": dados.Telefone,
                "Celular": dados.Celular,
                "Contato": dados.Cliente,
                "CPF": dados.CPF,
                "Sexo": dados.Sexo,
                "idUsuarioParceiro": sessao_json.Parceiro.id,
                "TipoCliente": dados.TipoCliente,
                "Cep": dados.Cep,
                "UF": dados.UF,
                "Cidade": dados.Cidade,
                "Bairro": dados.Bairro,
                "Logradouro": dados.Logradouro,
                "Complemento": dados.Complemento,
                "Numero": Complemento.Numero,
                "Produto": {}
            }

            if (tipo_cliente != undefined) {
                payload.Produto = {
                    "idProdutoIndicacao": dados.idProdutoIndicacao,
                    "idTipoCliente": tipo_cliente.toString(),
                    "idTipoOperacao": dados.idTipoOperacao,
                    "idTipoUso": dados.idTipoUso,
                    "idTipoImovel": dados.idTipoImovel,
                    "ValorBem": dados.ValorBem,
                    "PrimeiroBairroPreferencia": dados.PrimeiroBairroPreferencia,
                    "SegundoBairroPreferencia": dados.SegundoBairroPreferencia,
                    "TerceiroBairroPreferencia": dados.TerceiroBairroPreferencia
                }
            }
            if (tipo_financiamento != undefined) {
                payload.Produto = {
                    "idProdutoIndicacao": dados.idProdutoIndicacao,
                    "idTipoBem": dados.idTipoBem,
                    "idTipoFinanciamento": dados.idTipoFinanciamento,
                    "RendaComprovadaFaturamento": dados.RendaComprovadaFaturamento,
                    "ValorBem": dados.ValorBem,
                    "ValorFinanciamento": dados.ValorFinanciamento,
                    "CompraImediata": dados.CompraImediata
                }
            }
            $.gApi.exec('POST', url, payload,
                function(retorno) {
                    if (retorno.Code >= 200 && retorno.Code < 300) {
                        swal({
                            title: 'Sucesso',
                            text: retorno.Message.Success,
                            type: 'success'
                        }).then((result) => {
                            location.reload();
                        });
                    }
                }
            );
        }
        return false;
    });

    // Paginanção



    // Carregamentos

    // tipo Imovel | Imóvel
    $('#idTipoUso').change(function() {
        var value = $(this).val()
        if (value != '') {
            carregaTipoImovel(value);
        }
    });

    // Busca CEP
    $('#Cep').autocompleteAddress({
        setReadonly: true,
        setDisabled: false
    });


    $('#formEditarprodutos #id').change(function() {
        var id_produto = $(this).children("option:selected").val();
        var url = 'http://integracaogtsis.tempsite.ws/api/ProdutosIndicacao/' + id_produto;
        console.log(id_produto == '');

        if (id_produto != '') {
            $.gApi.exec('GET', url, {},
                function(retorno) {
                    if (retorno.id) {
                        $('#formEditarprodutos #titulo').val(retorno.Titulo).removeAttr('disabled');
                        $('#formEditarprodutos #ativo').val(retorno.Ativo.toString()).removeAttr('disabled');
                        $('#formEditarprodutos #subTitulo').val(retorno.SubTitulo).removeAttr('disabled');
                        $('#formEditarprodutos #url').val(retorno.Url).removeAttr('disabled');
                        $('#formEditarprodutos #imagemBase64').val(retorno.imagemBase64);
                        $('#formEditarprodutos #imagem').removeAttr('disabled');
                    }
                });
        } else {
            $('#formEditarprodutos #titulo').val('').attr('disabled');
            $('#formEditarprodutos #ativo').val('').attr('disabled');
            $('#formEditarprodutos #subTitulo').val('').attr('disabled');
            $('#formEditarprodutos #url').val('').attr('disabled');
            $('#formEditarprodutos #imagemBase64').val('');
            $('#formEditarprodutos #imagem').attr('disabled');
        }
    });

    $('#imagem').change(function() {
        var file = document.querySelector('#formEditarprodutos #imagem').files[0];
        if (file.size) {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() {
                $('#formEditarprodutos #imagemBase64').val(reader.result);
            };
        }
    });

    $('#formEditarprodutos').submit(function() {
        var dados = $(this).serializeObject();
        var url = 'http://integracaogtsis.tempsite.ws/api/ProdutosIndicacao';
        if (dados.imagemBase64) {
            var res = dados.imagemBase64.split(",");
            var extensao = res[0].split(";");
            dados.extensao = '.' + extensao[0].split("/")[1];
        }

        $.gApi.exec('PUT', url, dados,
            function(retorno) {
                if (retorno.Code == 200) {
                    alerta('Sucesso', retorno.Message.Success, 'success', null);
                }
            });


        return false;
    });


    // modal
    $(document).on('click', '.abre_detalhe', function() {
        var _this = $(this);
        var _id = _this.attr('href');
        var item = filtraObjeto(_obj_paginacao, _id);

        $('#modal_detalhes').find('.modal-body').html(montaDetalhe(item, id_produto));
        $('#modal_detalhes').modal('show');
        return false;
    })


})(jQuery);
var _obj_paginacao;

// Imovel
function carregaTipoOperacao() {

    if ($('#idTipoOperacao').length > 0) {
        var url = 'http://integracaogtsis.tempsite.ws/api/Imoveis/TipoOperacao';
        $.gApi.exec('GET', url, {},
            function(retorno) {
                $('#idTipoOperacao').html(populaSelect(retorno, 'id', 'Tipo'));
            });
    }
}

function carregaTipoUso() {

    if ($('#idTipoUso').length > 0) {
        console.log('carregou');
        var url = 'http://integracaogtsis.tempsite.ws/api/Imoveis/TipoUso';
        $.gApi.exec('GET', url, {},
            function(retorno) {
                $('#idTipoUso').html(populaSelect(retorno, 'id', 'Tipo')).removeAttr('disabled');
            });
    }
}

function carregaTipoImovel(tipo_uso) {

    if ($('#idTipoImovel').length > 0) {
        console.log('carregou');
        var url = 'http://integracaogtsis.tempsite.ws/api/Imoveis/TipoImovel/Uso/' + tipo_uso;
        $.gApi.exec('GET', url, {},
            function(retorno) {
                $('#idTipoImovel').html(populaSelect(retorno, 'id', 'Tipo')).removeAttr('disabled');
            });
    }
}

// financiamento
function carregaTipoBem() {

    if ($('#idTipoBem').length > 0) {
        console.log('carregou');
        var url = 'http://integracaogtsis.tempsite.ws/api/Bens/Tipos';
        $.gApi.exec('GET', url, {},
            function(retorno) {
                var _localStorage = JSON.parse(localStorage.getItem("sc_parceiros"));
                _localStorage.tipo_bem = retorno;
                console.log(_localStorage);

                localStorage.setItem('sc_parceiros', JSON.stringify(_localStorage))
                $('#idTipoBem').html(populaSelect(retorno, 'id', 'Tipo'));
            });
    }
}

function getTipoBem() {
    var url = 'http://integracaogtsis.tempsite.ws/api/Bens/Tipos';
    $.gApi.exec('GET', url, {},
        function(retorno) {
            var _localStorage = JSON.parse(localStorage.getItem("sc_parceiros"));
            _localStorage.tipo_bem = retorno;
            localStorage.setItem('sc_parceiros', JSON.stringify(_localStorage));
        });
}

function carregaMenuTopo() {
    var _localStorage = JSON.parse(localStorage.getItem("sc_parceiros"));
    var produtos = _localStorage.produtos;
    var html = '';
    $.each(produtos, function(i, e) {
        if (e.id != id_produto) {
            var url = (e.Url) ? url_sys + 'pag/indicacao/' + e.Url + '.php' : '#';
            var titulo = (e.Titulo) ? e.Titulo : e.Produto;
            html += '<li><a href="' + url + '">' + titulo + '</a></li>';
        }
    });
    $('.menu-produtos').html(html);
}

//
function listaProdutos() {
    var _localStorage = JSON.parse(localStorage.getItem("sc_parceiros"));
    var produtos = _localStorage.produtos;
    var html = '';
    html += '<option value="" delected>Selecione...</option>';
    $.each(produtos, function(i, e) {
        var titulo = (e.Titulo) ? e.Titulo : e.Produto;
        html += '<option value="' + e.id + '">' + titulo + '</option>';
    });
    $('#formEditarprodutos #id').html(html);
}


// Dropdowns Script
// $(document).ready(function() {
//     $(document).on('click', function(ev) {
//         ev.stopImmediatePropagation();
//         $(".dropdown-toggle").dropdown("active");
//     });
// });



/************** Search ****************/
$(function() {
    var button = $('#loginButton');
    var box = $('#loginBox');
    var form = $('#loginForm');
    button.removeAttr('href');
    button.mouseup(function(login) {
        box.toggle();
        button.toggleClass('active');
    });
    form.mouseup(function() {
        return false;
    });
    $(this).mouseup(function(login) {
        if (!($(login.target).parent('#loginButton').length > 0)) {
            button.removeClass('active');
            box.hide();
        }
    });

    // TABLE
    var table = $('#table');
    // Table hover
    $('#table-hover').change(function() {
        var value = $(this).val();
        table.removeClass('table-hover').addClass(value);
    });
});


function filtrar() {
    if ($('form#filtrar').length > 0) {
        var idUsuarioParceiro = $('form#filtrar').find('input[name=idUsuarioParceiro]').val();
        var periodo = $('form#filtrar').find('input[name=periodo]').val();
        var data = periodo.split('|');

        var idParceiro = sessao_json.Parceiro.id;
        var NumeroPagina = 1;
        var TamanhoPagina = 10;
        var idUsuarioParceiro = sessao_json.id;
        var idProduto = id_produto;
        var url_paginacao = "http://integracaogtsis.tempsite.ws/api/Indicacoes/Supercredito/Parceiros/" + idParceiro + "?TamanhoPagina=" + TamanhoPagina + "&DataInicial=" + data[0] + "&DataFinal=" + data[1] + "&idUsuarioParceiro=" + idUsuarioParceiro + "&idProduto=" + idProduto + "&NumeroPagina=" + NumeroPagina;

        $.gApi.exec('GET', url_paginacao, {},
            function(retorno) {
                if (retorno.Data == null) {
                    $('#container_rows').html('<p>Nenum resultado encontrado.</p>');
                } else {
                    _obj_paginacao = retorno.Data;
                    $('#container_rows').html(templatePagination(retorno.Data));
                }
                $('#paginacao').bootpag({
                    total: retorno._Links.TotalPages,
                    page: 1,
                    maxVisible: 5,
                    // leaps: true,
                    wrapClass: 'pagination',
                    activeClass: 'active',
                    disabledClass: 'disabled',
                    nextClass: 'next',
                    prevClass: 'prev',
                    lastClass: 'last',
                    firstClass: 'first'
                }).on("page", function(event, num) {
                    NumeroPagina = num;
                    url_paginacao = "http://integracaogtsis.tempsite.ws/api/Indicacoes/Supercredito/Parceiros/" + idParceiro + "?TamanhoPagina=" + TamanhoPagina + "&DataInicial=" + data[0] + "&DataFinal=" + data[1] + "&idUsuarioParceiro=" + idUsuarioParceiro + "&idProduto=" + idProduto + "&NumeroPagina=" + NumeroPagina;
                    $.gApi.exec('GET', url_paginacao, {},
                        function(retorno) {
                            _obj_paginacao = retorno.Data;
                            $('#container_rows').html(templatePagination(retorno.Data));
                            $("html, body").animate({ scrollTop: 0 }, 1000);
                        });
                });
            });
    }
}

function templatePagination(data) {
    if (data != null) {
        var html = '';
        html += '<div class="table_person">';
        html += '<div class="row_person header_person">';
        html += '<div class="cell_person">Nome</div>';
        html += '<div class="cell_person">Telefone</div>';
        html += '<div class="cell_person">Celular</div>';
        html += '<div class="cell_person">E-mail</div>';
        html += '<div class="cell_person">Status</div>';
        html += '</div>';
        $.each(data, function(i, e) {
            html += '<div class="row_person">';
            html += '<div class="cell_person" data-title="Nome"><a href="' + e.id + '" class="abre_detalhe" >' + limpaNulo(e.Cliente.Nome) + '</a></div>';
            html += '<div class="cell_person" data-title="Telefone">' + limpaNulo(e.Cliente.Telefone) + '</div>';
            html += '<div class="cell_person" data-title="Telefone">' + limpaNulo(e.Cliente.Celular) + '</div>';
            html += '<div class="cell_person" data-title="E-mail">' + limpaNulo(e.Cliente.Email) + '</div>';
            html += '<div class="cell_person" data-title="Status"><small>' + limpaNulo(e.StatusProspect.Descricao) + '</small></div>';
            html += '</div>';
        });
    }
    return html;
}

function montaDetalhe(data, tipo) {
    console.log(data);
    console.log(tipo);
    var telefone = [data.Cliente.Telefone, data.Cliente.Celular];
    var contato = telefone.join(' | ');
    var sexo = (data.Cliente.Sexo == 'M') ? 'Masculino' : 'Feminino';
    var pj = (data.Cliente.PJ) ? 'Pessoa Jurídica' : 'Pessoa Física';
    var tipoPessoa = (data.Cliente.PJ) ? 'CNPJ' : 'CPF';
    var html = '';
    html += '<div class="detalhe-negocio">';
    html += '<div class="row item-box">';
    html += '<div class="col-md-12 subtitulo"><h4>Dados do cliente</h4></div>';
    html += '<div class="col-md-5 item-detalhe"><span>Nome</span>' + limpaNulo(data.Cliente.Nome) + '</div>';
    html += '<div class="col-md-5 item-detalhe"><span>E-mail</span>' + limpaNulo(data.Cliente.Email) + '</div>';
    html += '<div class="col-md-2 item-detalhe"><span>Tipo</span>' + limpaNulo(pj) + '</div>';
    html += '<div class="col-md-3 item-detalhe"><span>Telefone</span>' + limpaNulo(data.Cliente.Telefone) + '</div>';
    html += '<div class="col-md-3 item-detalhe"><span>Celular</span>' + limpaNulo(data.Cliente.Celular) + '</div>';
    html += '<div class="col-md-3 item-detalhe"><span>Sexo</span>' + limpaNulo(sexo) + '</div>';
    html += '<div class="col-md-3 item-detalhe"><span>' + limpaNulo(tipoPessoa) + '</span>' + limpaNulo(data.Cliente.CpfCnpj) + '</div>';
    html += '</div>';
    // IMOVEL
    if (tipo == 1) {
        html += '<div class="row item-box">';
        html += '<div class="col-md-12 subtitulo"><h4>Dados do negócio</h4></div>';
        html += '<div class="col-md-4 item-detalhe"><span>Bem</span>' + limpaNulo(data.Cliente.DetalhesIndicacaoImovel.Bem) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Tipo do cliente</span>' + limpaNulo(data.Cliente.DetalhesIndicacaoImovel.TipoCliente) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Tipo do imóvel</span>' + limpaNulo(data.Cliente.DetalhesIndicacaoImovel.TipoImovel) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Operação</span>' + limpaNulo(data.Cliente.DetalhesIndicacaoImovel.TipoOperacao) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Uso</span>' + limpaNulo(data.Cliente.DetalhesIndicacaoImovel.TipoUso) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Valor</span>R$' + limpaNulo(data.Cliente.DetalhesIndicacaoImovel.ValorBem) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Bairro 1</span>' + limpaNulo(data.Cliente.DetalhesIndicacaoImovel.PrimeiroBairroPreferencia) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Bairro 2</span>' + limpaNulo(data.Cliente.DetalhesIndicacaoImovel.SegundoBairroPreferencia) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Bairro 3</span>' + limpaNulo(data.Cliente.DetalhesIndicacaoImovel.TerceiroBairroPreferencia) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Status</span>' + limpaNulo(data.StatusProspect.Descricao) + '</div>';
        html += '</div>';
    }
    // FINANCIAMENTO
    if (tipo == 2) {
        html += '<div class="row item-box">';
        html += '<div class="col-md-12 subtitulo"><h4>Dados do negócio</h4></div>';
        html += '<div class="col-md-4 item-detalhe"><span>Compra imediata</span>' + ((data.Cliente.DetalhesIndicacaoFinanciamentos.CompraImediata) ? 'Sim' : 'Não') + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Tipo do bem</span>' + limpaNulo(data.Cliente.DetalhesIndicacaoFinanciamentos.TipoBem) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Renda comprovada</span>R$' + limpaNulo(data.Cliente.DetalhesIndicacaoFinanciamentos.RendaComprovadaFaturamento) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Valor do bem</span>R$' + limpaNulo(data.Cliente.DetalhesIndicacaoFinanciamentos.ValorBem) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Valor do financiamento</span>R$' + limpaNulo(data.Cliente.DetalhesIndicacaoFinanciamentos.ValorBem) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Status</span>' + limpaNulo(data.StatusProspect.Descricao) + '</div>';
        html += '</div>';
    }
    // CONSORCIO
    if (tipo == 3) {
        html += '<div class="row item-box">';
        html += '<div class="col-md-12 subtitulo"><h4>Dados do negócio</h4></div>';
        html += '<div class="col-md-4 item-detalhe"><span>Tipo do bem</span>' + limpaNulo(data.Cliente.DetalhesIndicacaoConsorcios.TipoBem) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Valor do bem</span>R$' + limpaNulo(data.Cliente.DetalhesIndicacaoConsorcios.ValorBem) + '</div>';
        html += '<div class="col-md-12 item-detalhe"><span>Observação</span>' + limpaNulo(data.Cliente.DetalhesIndicacaoConsorcios.Observacao) + '</div>';
        html += '<div class="col-md-4 item-detalhe"><span>Status</span>' + limpaNulo(data.StatusProspect.Descricao) + '</div>';
        html += '</div>';
    }
    html += '</div>';
    return html;
}

function getSessionStorage() {
    var _localStorage = JSON.parse(localStorage.getItem("sc_parceiros"));

    return _localStorage;
}


function filtraObjeto(data, id) {
    var retorno = [];
    $.each(data, function(i, e) {
        if (e.id == id) {
            retorno = e
        }
    });
    return retorno;
}

function limpaNulo(str) {
    if (str == null) {
        return '-';
    }
    return str;
}

function getBase64(file) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function() {
        return reader.result;
    };
    reader.onerror = function(error) {
        //   console.log('Error: ', error);
        return;
    };
}