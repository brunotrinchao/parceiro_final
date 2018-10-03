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
                    console.log(xhr);

                    var response = (xhr.responseText) ? $.parseJSON(xhr.responseText) : { error: { message: 'Erro desconhecido', code: 500 } };

                    if (typeof callbackError === 'function') {
                        swal.close();
                        callbackError.call(this, xhr);
                    }

                    displayError = (displayError === undefined) ? true : displayError;
                    if (response.code >= 400 && displayError) {
                        swal.close();
                        alerta('Erro', response.error.message, 'error');
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
                        alerta('Erro', response.error.message, 'error');
                    }

                    if (typeof callbackSuccess === 'function') {
                        swal.close();
                        callbackSuccess.call(this, json);
                    }
                }
            });
        },
        paginate: function(links, targetPreloader, targetPagination, callbackRender, callback) {
            var html = '<div class="row-fluid paginate">';

            html += '<div class="span12">';
            html += '<div class="pagination no-margin text-center" data-current="' + links.self + '">';
            if (links.total_pages > 0) {
                html += '<div class="summary">Página ' + links.page + ' de ' + links.total_pages + '</div>';
            }

            if (links.total_pages > 1) {
                html += '<ul>';
                html += '<li class="link first ' + (!links.first ? 'disabled' : '') + '"><a>&lt;&lt;</a></li>';
                html += '<li class="link prev ' + (!links.prev ? 'disabled' : '') + '"><a>&lt;</a></li>';
                html += '<li class="link next ' + (!links.next ? 'disabled' : '') + '"><a>&gt;</a></li>';
                html += '<li class="link last ' + (!links.last ? 'disabled' : '') + '"><a>&gt;&gt;</a></li>';
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
                    var endpoint = '';
                    switch (action) {
                        case 'next':
                            endpoint = links.next;
                            break;
                        case 'prev':
                            endpoint = links.prev;
                            break;
                        case 'last':
                            endpoint = links.last;
                            break;
                        case 'first':
                            endpoint = links.first;
                            break;
                    }
                    if (endpoint) {
                        $.gApi.exec('GET', endpoint, {},
                            function(json) {
                                callbackRender.call(this, json);
                                if (typeof callback === 'function') {
                                    callback.call(this, json);
                                }
                            }, false, targetPreloader
                        );
                    }
                }
            });
        }
    }
})(jQuery);