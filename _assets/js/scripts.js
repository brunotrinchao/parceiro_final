(function() {
    "use strict";

    // custom scrollbar

    // $("html").niceScroll({styler:"fb",cursorcolor:"#27cce4", cursorwidth: '5', cursorborderradius: '10px', background: '#424f63', spacebarenabled:false, cursorborder: '0',  zindex: '1000'});

    $(".left-side").niceScroll({ styler: "fb", cursorcolor: "#27cce4", cursorwidth: '3', cursorborderradius: '10px', background: '#424f63', spacebarenabled: false, cursorborder: '0' });


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
                    jQuery('.main-content').css({ height: '' });
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
                jQuery('.custom-nav li.active ul').css({ display: 'block' });

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

            jQuery('body').css({ left: '', marginRight: '' });
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

    var SPMaskBehavior = function (val) {
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

    //---------
    // Muda CPF CNPJ
    $('input[name=TipoCliente]').change(function(){
        if($(this).val() == 'PJ'){
            $('#lbl_cpf').text('CNPJ*');
        }else if($(this).val() == 'PF'){
            $('#lbl_cpf').text('CPF*');
        }         
    });

    $('#formNovaIndicacao').submit(function(){
        if(!$('form').gValidate()){
            var url = 'http://integracaogtsis.tempsite.ws/api/V1/Indicacoes/Supercredito';
            var dados = $(this).serializeObject();
            $.gApi.exec('POST', url, dados,
                function(retorno){
                console.log(retorno);
            });
            console.log(dados);
            
        }
        return false;
    });


})(jQuery);

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
});