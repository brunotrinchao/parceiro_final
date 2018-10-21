<?php

/**
 * Classe para montar formularios
 */
class GFormParent {

    /**
     * Gerar HTML da abertura do formulário
     *
     * @param string $id Ex: 'frm_login' default = 'form'
     * @param string $class Ex: form-horizontal default = 'form-vertical'
     * @param string $method Ex: 'get' default = 'post'
     * @param string $target Ex: '_blanc' default = '_self'
     * @param string $action Ex: 'frm_login.php' default = false
     * @param bool $enctype true ou false
     * @return string HTML de abertura do formulário gerado
     */
    function open($id = 'form', $class = 'form-vertical', $method = 'post', $target = '_self', $action = '', $enctype = false, $charset = "UTF-8") {
        $return = '<form id="' . $id . '" class="' . $class . '" method="' . $method . '" target="' . $target . '"';
//        if ($action)
        $return .= ' action="' . $action . '"';

        if ($enctype)
            $return .= ' enctype="multipart/form-data"';

        if ($charset)
            $return .= ' accept-charset="' . $charset . '"';

        $return .= ' >';

        return $return;

    }

    /**
     * Gerar HTML de fechamento do formulário
     *
     * @return string HTML do fechamento do formulário gerado
     */
    function close() {
        return '</form>';
    }

    /**
     * Gerar HTML e JS de Tabs do jQuery UI
     *
     * @param string $idTab
     * @param array $arrayTitles array('tab1' => 'Título 1','tab2' => 'Título 2')
     * @param array $arrayContents array('tab1' => $conteudo1, 'tab2' => $conteudo2)
     * @param array $arrayOptions opções do jQuery UI Tabs
     * @return string
     */
    function addTabs($idTab, $arrayTitles, $arrayContents, $arrayOptions = null, $marginTop=null) {
        $return = '';

        $return .= '<div class="tabbable tabbable-custom">';
        $style='';
        if($marginTop!=null & $marginTop!=''){
            $style= $marginTop;
        }
        $return .= '<ul id="' . $idTab . '" class="nav nav-tabs" '.$style.'>';
        foreach ($arrayTitles as $id => $title) {
            $return .= '<li><a href="#' . $id . '" data-toggle="tab">' . $title . '</a></li>';
        }
        $return .= '</ul>';

        $return .= '<div id="' . $idTab . 'Content" class="tab-content">';
        foreach ($arrayContents as $id => $content) {
            $return .= '<div id="' . $id . '" class="tab-pane">';
            $return .= $content;
            $return .= '<div class="__clear"></div>';
            $return .= '</div>';
        }
        $return .= '</div>';
        $return .= '</div>';

        $return .= '<script>$(function(){ jQuery("#' . $idTab . ' a:first").tab("show"); });</script>';

        return $return;
    }

    /**
     * Gerar HTML de label
     *
     * @param string $id Ex: 'nome'
     * @param string $title Ex: 'Nome'
     * @param array $param Ex: 'class'=>'cls_label' default = false
     * @return string HTML do label gerado
     */
    function addLabel($id, $title, $param = false) {
        $return = '';
        $idLabel = 'lbl_' . $id;
        $return .= '<label id="' . $idLabel . '" for="' . $id . '" ';
        if ($param) {
            foreach ($param as $key => $value) {
                $return .= ' ' . $key . '="' . $value . '"';
            }
        }
        $return .= '>' . $title . '</label>';

        return $return;
    }

    function addLegend($legend) {
        return '<span class="add-on">' . $legend . '</span>';
    }

    /**
     * Gerar HTML de input
     *
     * @param string $type Ex: 'text', 'password', 'button'
     * @param string $id Ex: 'txt_nome'
     * @param string $title Ex: 'Nome' default = false
     * @param array $fieldParam Ex: 'class'=>'cls_campo', 'size'=>'100' default = false
     * @param array $titleParam Ex: 'class'=>'cls_titulo' default = false
     * @param array $legends Ex: array('A'=>'R$', 'B'=>'Ex:1') default = false [After ou Before]
     * @param bool $control Default: true
     * @return string HTML do input gerado
     */
    function addInput($type, $id, $title = false, $fieldParam = false, $titleParam = false, $legends = false, $control = true) {
        $return = $a = $b = '';

        $return .= ($control) ? '<div class="control-group">' : '';

        if ($title) {
            $class .= ($control) ? ' control-label' : '';
            $titleParam['class'] .= $class;

            $return .= $this->addLabel($id, $title, $titleParam);
        }
        if ($legends) {
            $c = '';
            foreach ($legends as $legendType => $legendText) {
                $c = '';
                if ($legendType == 'A') {
                    $legendAfter = $this->addLegend($legendText);
                    $c .= ' input-append';
                } else {
                    $legendBefore = $this->addLegend($legendText);
                    $c .= ' input-prepend';
                }
            }
            $b = '<div class="' . $c . '">';
            $a = '</div>';
        }

        $return .= ($control) ? '<div class="form-group">' : '';
        $return .= $b;

        $name = $id;
        if (strpos($id, '[]') !== FALSE) {
            $id = str_replace('[]', '', $id) . '-' . randomString(5);
        }

        $return .= $legendBefore . '<input type="' . $type . '" id="' . $id . '" name="' . $name . '"';
        if ($fieldParam) {
            foreach ($fieldParam as $parametro => $value) {
                if ($parametro == 'tooltip') {
                    $tooltip = $value;
                } else if ($parametro == 'popover') {
                    $popover = $value;
                } else {
                    $return .= ' ' . $parametro . '="' . htmlspecialchars($value) . '"';
                }
            }
        }

        if ($tooltip) {
            $return = str_ireplace('class="', 'class="tooltips ', $return);
            $return .= ' ' . 'data-trigger="hover" data-original-title="' . $tooltip . '"';
        }

        if ($popover) {
            $return = str_ireplace('class="', 'class="popovers ', $return);
            $return .= ' ' . 'data-trigger="hover" data-content="' . $popover . '"';
        }

        $return .= ' />' . $legendAfter;
        $return .= $a;

        $return .= ($control) ? '</div>' : ''; // .controls
        $return .= ($control) ? '</div>' : ''; // .control-label

        return $return;
    }

    /**
     * Gerar HTML de <button>
     *
     * @param string $id
     * @param string $title
     * @param array $fieldParam
     */
    function addButton($id, $title, $fieldParam = false, $type = 'button', $ajuda = '', $ajudadirecao = 'top') {
        $return = '';
        $paramsbut = '';
        if($ajuda != '') {
            $mysql = new GDbMysql();
            $query = "SELECT aju_var_pagina, aju_var_titulo FROM vw_adm_ajuda WHERE aju_var_chave = ? ";
            $param = array('s', $ajuda);
            $mysql->execute($query, $param);
            $mysql->fetch();
            $aju_var_pagina = $mysql->res['aju_var_pagina'];
            $aju_var_titulo = $mysql->res['aju_var_titulo'];
            $mysql->freeResult();
            $paramsbut = 'data-placement="' . $ajudadirecao . '" data-content="' . $aju_var_titulo . '" data-trigger="hover"';
        }

        $return = '<button type="' . $type . '" id="' . $id . '"' . $paramsbut;
        if ($fieldParam) {
            foreach ($fieldParam as $parametro => $value) {
                if ($parametro == 'tooltip') {
                    $tooltip = $value;
                } else if ($parametro == 'popover') {
                    $popover = $value;
                } else {
                    $return .= ' ' . $parametro . '="' . htmlspecialchars($value) . '"';
                }
            }
        }

        if ($tooltip) {
            $return = str_ireplace('class="', 'class="tooltips ', $return);
            $return .= ' ' . 'data-trigger="hover" data-original-title="' . $tooltip . '"';
        }

        if ($popover) {
            $return = str_ireplace('class="', 'class="popovers ', $return);
            $return .= ' ' . 'data-trigger="hover" data-content="' . $popover . '"';
        }

        $return .= '>' . $title . '</button>';
        return $return;
    }

    /**
     * Gerar HTML de textarea
     *
     * @param string $id Ex: 'txt_texto' default = 'textarea'
     * @param string $text Ex: 'texto de exemplo' default = ''
     * @param string $title Ex: 'Texto' default = false
     * @param array $fieldParam Ex: 'class'=>'cls_campo', 'cols'=>'10' 'rols'=>'3' default = false
     * @param array $titleParam Ex: 'class'=>'cls_titulo' default = false
     * @param array $legends Ex: array('A'=>'R$', 'B'=>'Ex:1') default = false [After ou Before]
     * @param bool $control Default: true
     * @return string HTML do textarea gerado
     */
    function addTextarea($id, $text = '', $title = false, $fieldParam = false, $titleParam = false, $legends = false, $control = true) {
        $return = $a = $b = '';

        $return .= ($control) ? '<div class="control-group">' : '';

        if ($title) {
            $class .= ($control) ? ' control-label' : '';
            $titleParam['class'] .= $class;

            $return .= $this->addLabel($id, $title, $titleParam);
        }


        if ($legends) {
            $c = '';
            foreach ($legends as $legendType => $legendText) {
                $c = '';
                if ($legendType == 'A') {
                    $legendAfter = $this->addLegend($legendText);
                    $c .= ' input-append';
                } else {
                    $legendBefore = $this->addLegend($legendText);
                    $c .= ' input-prepend';
                }
            }
            $b = '<div class="' . $c . '">';
            $a = '</div>';
        }

        $return .= ($control) ? '<div class="controls">' : '';

        $return .= $legendBefore . '<textarea id="' . $id . '" name="' . $id . '"';
        if ($fieldParam) {
            foreach ($fieldParam as $parametro => $value) {
                $return .= ' ' . $parametro . '="' . htmlspecialchars($value) . '"';
            }
        }
        $return .= '>' . $text . '</textarea>' . $legendAfter;
        $return .= $a;

        $return .= ($control) ? '</div>' : ''; // .controls
        $return .= ($control) ? '</div>' : ''; // .control-label

        return $return;
    }

    /**
     * Gerar HTML e Javascript para o funcionamento do CKEditor
     *
     * @param string $id Ex: 'txt_texto' default = 'textarea'
     * @param string $text Ex: 'texto de exemplo' default = ''
     * @param string $title Ex: 'Texto' default = false
     * @param array $fieldParam Ex: 'class'=>'cls_campo', 'cols'=>'10' 'rols'=>'3' default = false
     * @param array $configCkeditor
     * @param array $titleParam Ex: 'class'=>'cls_titulo' default = false
     * @param array $legends Ex: array('A'=>'R$', 'B'=>'Ex:1') default = false [After ou Before]
     * @param bool $control Default: true
     * @return String
     */
    function addCKEditor($id, $text = 'false', $title = false, $fieldParam = false, $configCkeditor = false, $titleParam = false, $legends = false, $control = true) {
        $return = '';

        $return .= $this->addTextarea($id, htmlspecialchars($text), $title, $fieldParam, $titleParam, $legends, $control);

        $config = '';
        if ($configCkeditor) {
            foreach ($configCkeditor as $key => $value) {
                $config .= $key . ":" . $value . ",";
            }
            $config = substr($config, 0, -1);
        }

        $return .= '<script>';
        $return .= '$(function(){ jQuery("#' . $id . '").ckeditor(function(){}, {' . $config . '} ); });';
        $return .= '</script>';

        return $return;
    }

    /**
     * Gerar HTML de Select/Combobox
     *
     * @param string $id Ex: 'slc_tipo' default = 'select'
     * @param array $options Ex: '0' => 'Inativo', '1' => 'Ativo' default = '-1' => 'selecione...'
     * @param string $selectOption Ex: '1' default = '-1'
     * @param string $title Ex: 'Tipo' default = false
     * @param array $fieldParam Ex: 'class' => 'cls_campo', 'size' => '1' 'multiple' => 'multiple' default = false
     * @param array $titleParam Ex: 'class'=>'cls_titulo' default = false
     * @param array $legends Ex: array('A'=>'R$', 'B'=>'Ex:1') default = false [After ou Before]
     * @param boolean $firstSelect "Para inserir o primeiro ítem 'Selecione...'" Ex: true (padrão), false
     * @param string $firstSelectValue o valor do primeiro elemento do combo
     * @param string $firstSelectText o texto do primeiro elemento do combo
     * @param bool $control Default: true
     * @param bool $hiddenLabel Default: true Insere ou não um input hidden que guarda a string do valor selecionado
     * @return string HTML do select gerado
     */
    function addSelect($id, $options, $selectedOption = '', $title = false, $fieldParam = false, $titleParam = false, $legends = false, $firstSelect = true, $firstSelectValue = '', $firstSelectText = 'Selecione...', $control = true, $hiddenLabel = true) {
        $return = $a = $b = '';

        $return .= ($control) ? '<div class="control-group">' : '';

        if ($title) {
            $class .= ($control) ? ' control-label' : '';
            $titleParam['class'] .= $class;

            $return .= $this->addLabel($id, $title, $titleParam);
        }
        if ($legends) {
            $c = '';
            foreach ($legends as $legendType => $legendText) {
                $c = '';
                if ($legendType == 'A') {
                    $legendAfter = $this->addLegend($legendText);
                    $c .= ' input-append';
                } else {
                    $legendBefore = $this->addLegend($legendText);
                    $c .= ' input-prepend';
                }
            }
            $b = '<div class="' . $c . '">';
            $a = '</div>';
        }

        $return .= ($control) ? '<div class="controls">' : '';
        $return .= $b;

        $name = $id;
        if (strpos($id, '[]') !== FALSE) {
            $id = str_replace('[]', '', $id) . '-' . randomString(5);
        }

        $return .= $legendBefore . '<select id="' . $id . '" ';
        if ($fieldParam) {
            if(array_key_exists('name', $fieldParam)){
                $return .= 'name="' . $fieldParam['name'] . '" ';
            } else {
                $return .= 'name="' . $name . '" ';
            }
            foreach ($fieldParam as $parametro => $value) {
                $return .= ' ' . $parametro . '="' . $value . '"';
            }
        }
        $return .= '>';

        if ($firstSelect)
            $options = array($firstSelectValue => $firstSelectText) + $options;
        foreach ($options as $key => $value) {
            $flagArray = is_array($selectedOption) ? in_array($key, $selectedOption) : false;
            if ($selectedOption === $key || $selectedOption == $key || $flagArray)
                $return .= '<option selected="selected" value="' . $key . '">' . $value . '</option>';
            else
                $return .= '<option value="' . $key . '">' . $value . '</option>';
        }

        $return .= '</select>' . $legendAfter;
        $return .= $a;

        // if ($hiddenLabel) {
        //     $return .= $this->addInput('hidden', $id . '_text', false, false, false, false, false);
        //     $return .= '<script> ';
        //     $return .= '$(function(){ $("#' . $id . '").change(function() { ';
        //     $return .= 'var selecteds = []; ';
        //     $return .= '$("#' . $id . ' :selected").each(function(i, selected){ selecteds[i] = $(selected).text(); }); ';
        //     $return .= '$("#' . $id . '_text").val(trim(selecteds.join("|"))); ';
        //     $return .= '});';
        //     // $return .= '$("#' . $id . '").change();';
        //     $return .= '});';
        //     $return .= '</script>';
        // }
        $return .= ($control) ? '</div>' : ''; // .controls
        $return .= ($control) ? '</div>' : ''; // .control-label

        return $return;
    }

    /**
     * Gerar HTML e Javascript para um campo de Data e/ou hora com jQuery UI
     *
     * @param string $id
     * @param string $title
     * @param boolean $hour
     * @param array $fieldParam
     * @param array $paramConfig
     * @param array $titleParam
     * @param boolean $readonly informa se o campo vai estar desabilitado ou não
     * @param boolean $control
     * @return string
     */
    function addDateField($id, $title, $hour = false, $fieldParam = false, $paramConfig = false, $legends = false, $titleParam = false, $readonly = false, $control = false) {
        $return = '';
        $fieldParam["value"] = ( $hour) ? substr(GF::convertDate($fieldParam["value"], false), 0, 16) : substr(GF::convertDate($fieldParam["value"], false), 0, 10);
        if ($fieldParam["validate"] != "")
            $fieldParam["validate"] = ($hour) ? $fieldParam["validate"] . ";dataHora" : $fieldParam["validate"] . ";data";
        else
            $fieldParam["validate"] = ($hour) ? "dataHora" : "data";

        if ($readonly)
            $fieldParam["readonly"] = "readonly";

        $return .= $this->addInput('text', $id, $title, $fieldParam, $titleParam, $legends, $control);
        $return .= '<script> $(function(){';
        $return .= ( $hour) ? 'jQuery("#' . $id . '").datetimepicker({' : 'jQuery("#' . $id . '").datepicker({';
        if ($paramConfig) {
            foreach ($paramConfig as $key => $value) {
                $return .= $key . ' : ' . $value . ',';
            }
            $return = substr($return, 0, -1);
        }
        $return .= '});';
        $return .= '}); </script>';
        return $return;
    }

    /**
     * Gerar HTML de input
     *
     * @param string $id Ex: 'txt_nome'
     * @param string $title Ex: 'Nome' default = false
     * @param array $fieldParam Ex: 'class'=>'cls_campo', 'size'=>'100' default = false
     * @param array $titleParam Ex: 'class'=>'cls_titulo' default = false
     * @param array $legends Ex: array('A'=>'R$', 'B'=>'Ex:1') default = false [After ou Before]
     * @param bool $control Default: true
     * @return string HTML do input gerado
     */
    function addDateTimePicker($id, $title = false, $fieldParam = false, $titleParam = false, $legends = false, $control = true) {
        $return = $a = $b = '';

        $return .= ($control) ? '<div class="control-group">' : '';

        if ($title) {
            $class .= ($control) ? ' control-label' : '';
            $titleParam['class'] .= $class;

            $return .= $this->addLabel($id, $title, $titleParam);
        }
        if ($legends) {
            $c = '';
            foreach ($legends as $legendType => $legendText) {
                $c = '';
                if ($legendType == 'A') {
                    $legendAfter = $this->addLegend($legendText);
                    $c .= ' input-append';
                } else {
                    $legendBefore = $this->addLegend($legendText);
                    $c .= ' input-prepend';
                }
            }
            $b = '<div class="' . $c . '">';
            $a = '</div>';
        }

        $return .= ($control) ? '<div class="controls">' : '';
        $return .= $b;
        $return .= $legendBefore . '<input type="' . $type . '" id="' . $id . '" name="' . $id . '"';
        if ($fieldParam) {
            foreach ($fieldParam as $parametro => $value) {
                $return .= ' ' . $parametro . '="' . htmlspecialchars($value) . '"';
            }
        }
        $return .= ' />' . $legendAfter;
        $return .= $a;

        $return .= ($control) ? '</div>' : ''; // .controls
        $return .= ($control) ? '</div>' : ''; // .control-label

        return $return;
    }

    /**
     * Gerar HTML e Javascript para um upload de arquivos
     *
     * @param string $id
     * @param string $title
     * @param array $param
     */
    function addUploadField($id, $title, $param) {
        $return = '';
        if ($title)
            $return .= $this->addLabel($id, $title);

        $return .= '<div id="' . $id . '"></div>';
        $return .= '<script>';
        $return .= 'jQuery("#' . $id . '").gFileUploader({';
        foreach ($param as $key => $value) {
            $return .= $key . ' : ' . $value . ',';
        }
        $return = substr($return, 0, -1);
        $return .= '});';
        $return .= '</script>';

        return $return;
    }

    /**
     * Gerar HTML e Javascript para um upload de arquivos passando parametros
     *
     * @param string $id Ex: 'img_1'
     * @param string $action Ex: "upload.php"
     * @param string $sizeLimite
     * @param string $element
     * @param string $local
     * @return string
     */
    function addUploadFieldParam($id, $action, $sizeLimite, $element, $local, $hidden) {
        $return = '';
        $param = array("action" => "'" . $action . "'",
            "multiple" => "false",
            "sizeLimit" => "'" . $sizeLimite . "'",
            "onComplete" => "function(id, fileName, json){
                        jQuery.gDisplay.loadStop('.__painelBotoes');
                        var filenameUpload = json.filename;
                        jQuery('#" . $element . "').attr('src', '" . $local . "'+filenameUpload);
                        jQuery('#" . $hidden . "').val(filenameUpload);
                        jQuery('.qq-upload-list').empty();
                        cortar(filenameUpload, '" . $element . "');
                    }",
            "onSubmit" => "function(id, fileName){
                        jQuery('.qq-upload-list').empty();
                        jQuery('" . $element . "').attr('src', '" . $local . "unknown.png');
                        jQuery('#" . $hidden . "').val('');
                        jQuery.gDisplay.loadStart('.__painelBotoes','');
                    }");

        $return .= '<div id="' . $id . '"></div>';
        $return .= '<script>';
        $return .= 'jQuery("#' . $id . '").gFileUploader({';
        foreach ($param as $key => $value) {
            $return .= $key . ' : ' . $value . ',';
        }
        $return = substr($return, 0, -1);
        $return .= '});';
        $return .= '</script>';

        return $return;
    }

    /**
     * Gerar HTML e JavaScript para a criação de um campo slider
     *
     * Como pegar e setar um valor no componente slider:<br>
     * get<br>
     * var value = $( ".selector" ).slider( "option", "atributo" );<br>
     * set<br>
     * $( ".selector" ).slider( "option", "atributo", 37 );<br>
     *
     * Atributos:<br>
     * disabled - Type: Boolean | Default: false<br>
     * animate - Type: Boolean, String, Number | Default: false<br>
     * max - Type: Number | Default: 100<br>
     * min - Type: Number | Default: 0<br>
     * orientation - Type: String | Default: 'horizontal'<br>
     * range - Type: Boolean, String | Default: false<br>
     * step - Type: Number | Default: 1<br>
     * value - Type: Number | Default: 0<br>
     * values - Type: Array | Default: null
     *
     * @param string $id
     * @param array $paramSlider
     * @param string $title
     * @param string $width 200px
     */
    function addSlider($id, $title = false, $paramSlider = false, $width = '200px') {
        $return = '';

        if ($title)
            $return .= $this->addLabel($id, $title);

        $return .= '<script>$(function(){ var slider = jQuery( \'<div id="sl_' . $id . '" class="slider" style="float: left;  width:' . $width . '"></div> \' ).slider({';
        $params = '';
        $fieldParam = false;
        if ($paramSlider) {
            foreach ($paramSlider as $param => $value) {
                $params .= $param . ':' . $value . ',';
                if ($param == 'value') {
                    $fieldParam = array("value" => $value);
                }
            }
            $return .= $params;
        }
        $return .= 'slide: function( event, ui ) { jQuery("#' . $id . '").val(ui.value); jQuery("#c_' . $id . '").html(ui.value); } });
            jQuery("#lbl_' . $id . '").after(\'<span id="c_' . $id . '" class="count"></span>\');
            jQuery("#lbl_' . $id . '").after(slider);

            jQuery(function() {
                jQuery("#c_' . $id . '").html(jQuery("#sl_' . $id . '").slider( "option", "value" ));
            });
        });</script>';
        $return .= $this->addInput('hidden', $id, false, $fieldParam);
        return $return;
    }

    /**
     * Gerar HTML de checkbox
     *
     * @param string $id Ex: 'ckb_nome'
     * @param string $title Ex: 'Nome' default = false
     * @param array $fieldParam Ex: 'class'=>'cls_campo', 'size'=>'100' default = false
     * @return string HTML do input gerado
     */
    function addCheckbox($id, $title = false, $fieldParam = false, $labelParam = false, $inline = false) {
        $return = '';
        $chk_inline = ($inline)? 'checkbox-inline' : 'checkbox';
        if ($title){
            $return .= '<label id="lbl_' . $id . '" class="' .$chk_inline. '" ';
            if ($labelParam) {
                foreach ($labelParam as $key => $value) {
                    $return .= ' ' . $key . '="' . $value . '"';
                }
            }
            $return .= '>';
        }

        $return .= '<input type="checkbox" id="' . $id . '" name="' . $id . '"';
        if ($fieldParam) {
            foreach ($fieldParam as $parametro => $value) {
                $return .= ' ' . $parametro . '="' . $value . '"';
            }
        }
        $return .= ' />';

        if ($title) {
            $return .= ' ' . $title;
            $return .= '</label>';
        }

        return $return;
    }

    /**
     * Gerar HTML de radio
     *
     * @param string $id Ex: 'rad_nome'
     * @param string $title Ex: 'Nome' default = false
     * @param array $fieldParam Ex: 'class'=>'cls_campo', 'size'=>'100' default = false
     * @return string HTML do input gerado
     */
    function addRadio($id, $title = false, $fieldParam = false, $inline = false) {
        $return = '';
        $chk_inline = ($inline)? 'radio-inline' : 'radio';
        if ($title)
            $return .= '<label class="'.$chk_inline.'">';

        $return .= '<input type="radio" id="' . $id . '" ';
        if ($fieldParam) {
            foreach ($fieldParam as $parametro => $value) {
                $return .= ' ' . $parametro . '="' . $value . '"';
            }
        }
        $return .= ' />';
        if ($title) {
            $return .= '' . $title;
            $return .= '</label>';
        }
        return $return;
    }

    /**
     * Gerar HTML de radiogroup
     *
     * @param string $idField
     * @param array $campos
     * @param string $checked
     * @return string
     */
    function addRadioGroup($idField, $campos, $checked) {
        $return = '';
        $return .= '<div id="div_' . $idField . '" class="__radioGroup">';
        if ($campos) {
            foreach ($campos as $id => $value) {
                $return .= '<input type="radio" id="' . $id . '" name="' . $idField . '" class="radio ' . $idField . '"';
                $return .= ( $checked == $id) ? ' checked ' : '';
                $return .= ' value="' . $id . '"/><label class="__labelRadio" for="' . $id . '">' . $value . '</label>';
            }
        }
        $return .= '</div>';
        return $return;
    }

}
