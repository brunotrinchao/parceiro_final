(function($) {
    $.gApi = {
        /**
         * [exec description]
         * @param  string method            GET/POST/PUT/DELETE
         * @param  string endpoint          Caminho para o recurso na API. Ex: /v1/recurso
         * @param  object param             Objeto com parâmetros para passar no body da requisição
         * @param  function callbackSuccess Função para ser executada caso dê tudo certo.
         * @param  function callbackError   Função para ser executada caso dê algum erro.
         * @param  boolean preloader         Define se a requisição vai ter ou não Preloader. Default: 'html'
         * @param  boolean withAuthorization Define se passa o Authorization ou não no Header da requisição. Default: true
         * @param  boolean async             Define se a requisição vai ser ou não Assincrona. Default: true
         * @param  boolean displayError      Define se a requisição vai exibir ou não a mensagem de erro da API. Default: true
         */
        exec: function(method, endpoint, param, callbackSuccess, callbackError, preloader, withAuthorization, async, displayError) {
            // var globals = window.gApiParams;
            // var url = globals.URL;
            var headers = {};
            // var target = '';

            // if (TIMEZONE !== undefined) {
            //     headers.Timezone = TIMEZONE;
            // }

            if (typeof localStorage === 'object') {
                try {
                    localStorage.setItem('localStorage', 1);
                    localStorage.removeItem('localStorage');
                } catch (e) {
                    Storage.prototype._setItem = Storage.prototype.setItem;
                    Storage.prototype.setItem = function() {};
                    console.log('Your web browser does not support storing settings locally. In Safari, the most common cause of this is using "Private Browsing Mode". Some settings may not save or some features may not work properly for you.');
                }
            }

            // if (withAuthorization === undefined || withAuthorization === true) {
            //     var authSessionStorage = sessionStorage.getItem('sv-authorization');
            //     var authLocalStorage = localStorage.getItem('sv-authorization');

            //     if (authSessionStorage != authLocalStorage) {
            //         if (authSessionStorage != null) {
            //             jQuery.gDisplay.showError("Erro ao carregar. Por favor recarregue a página e tente novamente.", function() {
            //                 sessionStorage.setItem('sv-authorization', authLocalStorage);
            //                 location.reload();
            //             });
            //             return false;
            //         } else {
            //             sessionStorage.setItem('sv-authorization', authLocalStorage);
            //         }
            //     }
            // }

            headers.Authorization = 'YnJ1bm86SW50ZWdyYWNhb1BhcmNlaXJvcw==';
            // console.log(param);
            async = (async === undefined) ? true: async;

            var new_param = (jQuery.isEmptyObject(param)) ? null : JSON.stringify(param);

            jQuery.ajax({
                type: method,
                url: endpoint,
                data: new_param,
                dataType: 'json',
                async: async,
                contentType: 'application/json',
                processData: true,
                headers: headers,
                beforeSend: function() {
                    if (preloader !== false) {
                        swal({
                            html: 'Carregando...',
                            showConfirmButton: false,
                            onOpen: () => {
                                swal.showLoading()
                            }
                        });
                    }
                },
                error: function(xhr) {

                    var response = (xhr.responseText) ? $.parseJSON(xhr.responseText) : { error: { message: 'Erro desconhecido', code: 500 } };

                    if (typeof callbackError === 'function') {
                        swal.close();
                        callbackError.call(this, xhr);
                    }

                    displayError = (displayError === undefined) ? true : displayError;
                    if (response.Code >= 400 && displayError) {
                        swal.close();
                        alerta('Erro', response.Message.Error.replace("\n", "<br>"), 'error');
                        return false;
                    }

                    if (preloader !== false) {
                        swal.close();
                        alerta('Erro', "Erro ao carregar. Por favor recarregue a página e tente novamente.", 'error');
                    }
                },
                success: function(json) {
                    if (preloader !== false) {
                        swal.close();
                    }

                    displayError = (displayError === undefined) ? true : displayError;
                    if (json.error && displayError) {
                        swal.close();
                        alerta('Erro', response.Message.Error.replace("\n", "<br>"), 'error');
                    }

                    if (typeof callbackSuccess === 'function') {
                        swal.close();
                        callbackSuccess.call(this, json);
                    }
                }
            });
        },
        paginate: function(links, targetPreloader, targetPagination, callbackRender, callback, endpoint) {
            var html = '<div class="row-fluid paginate">';
            console.log(links);
            
            html += '<div class="span12">';
            html += '<div class="pagination no-margin text-center" data-current="' + links.Self + '">';
            if (links.TotalPages > 0) {
                html += '<div class="summary">Página ' + links.Page + ' de ' + links.TotalPages + '</div>';
            }

            if (links.TotalPages > 1) {
                html += '<ul class="pagination">';
                html += '<li class="link first ' + (!links.First ? 'disabled' : '') + '"><a>&lt;&lt;</a></li>';
                html += '<li class="link prev ' + (!links.Prev ? 'disabled' : '') + '"><a>&lt;</a></li>';
                html += '<li class="link next ' + (!links.Next ? 'disabled' : '') + '"><a>&gt;</a></li>';
                html += '<li class="link last ' + (!links.Last ? 'disabled' : '') + '"><a>&gt;&gt;</a></li>';
                html += '</ul>';
            }

            html += '</div>';
            html += '</div>';

            html += '</div>';
            $(targetPagination).html(html).find('.link a').click(function() {
                var $li = $(this).parents('.link');
                var liClass = $li.attr('class');
                if (!$li.hasClass('disabled')) {
                    var action = liClass.replace('link ', '').trim();
                    var endpointFinal = '';
                    switch (action) {
                        case 'next':
                            endpointFinal = endpoint+links.Next;
                            break;
                        case 'prev':
                            endpointFinal = endpoint+links.Prev;
                            break;
                        case 'last':
                            endpointFinal = endpoint+links.Last;
                            break;
                        case 'first':
                            endpointFinal = endpoint+links.First;
                            break;
                    }
                    console.log(endpointFinal);
                    
                    if (endpointFinal) {
                        $.gApi.exec('GET', endpointFinal, {},
                            function(json) {
                                callbackRender.call(this, json._Links);
                                if (typeof callback === 'function') {
                                    callback.call(this, json._Links);
                                }
                            }, false, targetPreloader
                        );
                    }
                }
            });
        }
    }
})(jQuery);