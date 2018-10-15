<?php

class Form extends GFormParent{

    

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
        if (strpos($class, 'filterForm') !== false) {
            $class .= ' clearfix';
        }
        return parent::open($id, $class, $method, $target, $action, $enctype, $charset);
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
        if (strpos($fieldParam['class'], 'm-wrap') === false) {
            $fieldParam['class'] .= ' m-wrap';
        }
        return parent::addTextarea($id, $text, $title, $fieldParam, $titleParam, $legends, $control);
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
        if (strpos($fieldParam['class'], 'm-wrap') === false) {
            $fieldParam['class'] .= ' m-wrap';
        }
        return parent::addSelect($id, $options, $selectedOption, $title, $fieldParam, $titleParam, $legends, $firstSelect, $firstSelectValue, $firstSelectText, $control, $hiddenLabel);
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
        if (strpos($fieldParam['class'], 'm-wrap') === false) {
            $fieldParam['class'] .= ' m-wrap';
        }
        return parent::addInput($type, $id, $title, $fieldParam, $titleParam, $legends, $control);
    }

    /**
     *
     * @param int $id
     * @param string $title default=false
     * @param string $selected default=A
     * @param class $class default=sepH_b
     * @param string $classBtn default=''
     * @param bool $control default=true
     * @return string
     */
    function addStatus($id, $title = false, $selected = 'A', $class = 'sepH_b', $classBtn = '', $control = true) {
        $ativeA = $selected == 'A' ? 'active green' : '';
        $ativeI = $selected == 'I' ? 'active red' : '';

        if ($control) {
            $return .= '<div class="control-group">';
        }

        if ($title) {
            $return .= $this->addLabel($id, $title, array('class' => 'control-label'));
        }
        $return .= $this->addInput('hidden', $id, false, array('value' => $selected, 'class' => 'status'), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_ativo_' . $id . '" rel="A" class="btn ' . $ativeA . ' ' . $classBtn . '">Ativo</button>';
        $return .= '<button type="button" id="btn_inativo_' . $id . '" rel="I" class="btn ' . $ativeI . ' ' . $classBtn . '">Inativo</button>';
        $return .= '</div>';

        $return .= "<script>";
        $return .= "$('#btn_ativo_" . $id . "').click(function(){ ";
        $return .= "$('#" . $id . "').val('A'); ";
        $return .= "$('#btn_inativo_" . $id . "').removeClass('red'); ";
        $return .= "$('#btn_ativo_" . $id . "').addClass('green'); ";
        $return .= "}); ";
        $return .= "$('#btn_inativo_" . $id . "').click(function(){ ";
        $return .= "$('#" . $id . "').val('I'); ";
        $return .= "$('#btn_ativo_" . $id . "').removeClass('green'); ";
        $return .= "$('#btn_inativo_" . $id . "').addClass('red'); ";
        $return .= "}); ";
        $return .= "</script>";
        if ($control) {
            $return .= '</div>';
        }
        return $return;
    }

    /**
     *
     * @param string $id
     * @param bool $title = false
     * @param string $selected default = 'S'
     * @param string $class default = 'sepH_b'
     * @param string $classBtn default = ''
     * @param bool $control default=true
     * @return string
     */
    function addYesNo($id, $title = false, $selected = 'S', $class = 'sepH_b', $classBtn = '', $control = true) {
        $ativeA = $selected == 'S' ? 'active green' : '';
        $ativeI = $selected == 'N' ? 'active red' : '';

        if ($control) {
            $return .= '<div class="control-group">';
        }

        if ($title) {
            $return .= $this->addLabel($id, $title);
        }
        $return .= $this->addInput('hidden', $id, false, array('value' => $selected), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_sim_' . $id . '" rel="S" class="btn ' . $ativeA . ' ' . $classBtn . '">Sim</button>';
        $return .= '<button type="button" id="btn_nao_' . $id . '" rel="N" class="btn ' . $ativeI . ' ' . $classBtn . '">Não</button>';
        $return .= '</div>';

        $return .= "<script>
                        $('#btn_sim_" . $id . "').click(function(){
                            $('#" . $id . "').val('S').trigger('change');
                            $('#btn_nao_" . $id . "').removeClass('red');
                            $('#btn_sim_" . $id . "').addClass('green');
                        });
                        $('#btn_nao_" . $id . "').click(function(){
                            $('#" . $id . "').val('N').trigger('change');
                            $('#btn_sim_" . $id . "').removeClass('green');
                            $('#btn_nao_" . $id . "').addClass('red');
                        });
                    </script>";
        if ($control) {
            $return .= '</div>';
        }
        return $return;
    }

    /**
     *
     * @param string $id
     * @param bool $title = false
     * @param string $selected default = 'S'
     * @param string $class default = 'sepH_b'
     * @param string $classBtn default = ''
     * @param bool $control default=true
     * @return string
     */
    function addVendaOrcamento($id, $title = false, $selected = 'N', $class = 'sepH_b', $classBtn = '', $control = true) {
        $ativeA = $selected == 'S' ? 'active black' : '';
        $ativeI = $selected == 'N' ? 'active green' : '';

        if ($control) {
            $return .= '<div class="control-group">';
        }

        if ($title) {
            $return .= $this->addLabel($id, $title);
        }
        $return .= $this->addInput('hidden', $id, false, array('value' => $selected), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_venda_' . $id . '" rel="N" class="btn ' . $ativeI . ' ' . $classBtn . '">Venda</button>';
        $return .= '<button type="button" id="btn_orcamento_' . $id . '" rel="S" class="btn ' . $ativeA . ' ' . $classBtn . '">Orçamento</button>';
        $return .= '</div>';

        $return .= "<script>
                        $('#btn_orcamento_" . $id . "').click(function(){
                            $('#" . $id . "').val('S');
                            $('#btn_venda_" . $id . "').removeClass('green');
                            $('#btn_orcamento_" . $id . "').addClass('black');
                        });
                        $('#btn_venda_" . $id . "').click(function(){
                            $('#" . $id . "').val('N');
                            $('#btn_orcamento_" . $id . "').removeClass('black');
                            $('#btn_venda_" . $id . "').addClass('green');
                        });
                    </script>";
        if ($control) {
            $return .= '</div>';
        }
        return $return;
    }

    /**
     *
     * @param string $id
     * @param string $title
     * @param string $selected
     * @param bool $control default=true
     * @return string
     */
    function addLiberadoControlado($id, $title = false, $selected = 'N', $class = 'sepH_b', $classBtn = '', $control = true, $ajuda = '', $ajudapos = 'top') {
        $ativeA = $selected == 'N' ? 'active green' : '';
        $ativeI = $selected == 'S' ? 'active yellow' : '';

        if ($control) {
            $return .= '<div class="control-group liberadocontrolado">';
        }

        if ($title)
            $return .= $this->addLabel($id, $title);

        $return .= $this->addInput('hidden', $id, false, array('value' => $selected), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_liberado_' . $id . '" class="btn ' . $ativeA . ' ' . $classBtn . '" rel="N">Liberado</button>';
        $return .= '<button type="button" id="btn_controlado_' . $id . '" class="btn ' . $ativeI . ' ' . $classBtn . '" rel="S">Controlado</button>';

        $return .= '</div>';

        if($ajuda != '') {
            $return .= getSuporte($ajuda, $ajudapos, false);
        }

        $return .= "<script>
                        $('#btn_liberado_" . $id . "').click(function(){
                            $('#" . $id . "').val('N');
                            $('#btn_controlado_" . $id . "').removeClass('yellow');
                            $('#btn_liberado_" . $id . "').addClass('green');
                        });
                        $('#btn_controlado_" . $id . "').click(function(){
                            $('#" . $id . "').val('S');
                            $('#btn_liberado_" . $id . "').removeClass('green');
                            $('#btn_controlado_" . $id . "').addClass('yellow');
                        });
                    </script>";
        if ($control) {
            $return .= '</div>';
        }
        return $return;
    }

    /**
     *
     * @param string $id
     * @param string $title
     * @param string $selected
     * @param bool $control default=true
     * @return string
     */
    function addAcessoAgenda($id, $title = false, $selected = 'T', $class = 'sepH_b', $classBtn = '', $control = true) {
        $ativeA = $selected == 'T' ? 'active green' : '';
        $ativeI = $selected == 'P' ? 'active blue' : '';

        if ($control) {
            $return .= '<div class="control-group">';
        }

        if ($title)
            $return .= $this->addLabel($id, $title);

        $return .= $this->addInput('hidden', $id, false, array('value' => $selected), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_todas_' . $id . '" class="btn ' . $ativeA . ' ' . $classBtn . '" rel="T">Todas as agendas</button>';
        $return .= '<button type="button" id="btn_propria_' . $id . '" class="btn ' . $ativeI . ' ' . $classBtn . '" rel="P">Apenas a própria</button>';
        $return .= '</div>';

        $return .= "<script>
                        $('#btn_todas_" . $id . "').click(function(){
                            $('#" . $id . "').val('T');
                            $('#btn_propria_" . $id . "').removeClass('blue');
                            $('#btn_todas_" . $id . "').addClass('green');
                        });
                        $('#btn_propria_" . $id . "').click(function(){
                            $('#" . $id . "').val('P');
                            $('#btn_todas_" . $id . "').removeClass('green');
                            $('#btn_propria_" . $id . "').addClass('blue');
                        });
                    </script>";
        if ($control) {
            $return .= '</div>';
        }
        return $return;
    }

    /**
     *
     * @param string $id
     * @param string $title
     * @param string $selected
     * @param bool $control default=true
     * @return string
     */
    function addAcessoVenda($id, $title = false, $selected = 'V', $class = 'sepH_b', $classBtn = '', $control = true) {
        $ativeA = $selected == 'V' ? 'active green' : '';
        $ativeI = $selected == 'P' ? 'active blue' : '';

        if ($control) {
            $return .= '<div class="control-group">';
        }

        if ($title)
            $return .= $this->addLabel($id, $title);

        $return .= $this->addInput('hidden', $id, false, array('value' => $selected), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_todas_' . $id . '" class="btn ' . $ativeA . ' ' . $classBtn . '" rel="V">Tela de vendas</button>';
        $return .= '<button type="button" id="btn_propria_' . $id . '" class="btn ' . $ativeI . ' ' . $classBtn . '" rel="P">PDV</button>';
        $return .= '</div>';

        $return .= "<script>
                        $('#btn_todas_" . $id . "').click(function(){
                            $('#" . $id . "').val('V');
                            $('#btn_propria_" . $id . "').removeClass('blue');
                            $('#btn_todas_" . $id . "').addClass('green');
                        });
                        $('#btn_propria_" . $id . "').click(function(){
                            $('#" . $id . "').val('P');
                            $('#btn_todas_" . $id . "').removeClass('green');
                            $('#btn_propria_" . $id . "').addClass('blue');
                        });
                    </script>";
        if ($control) {
            $return .= '</div>';
        }
        return $return;
    }

    /**
     *
     * @param int $id
     * @param string $title default=false
     * @param string $selected default=A
     * @param class $class default=sepH_b
     * @param string $classBtn default=''
     * @return string
     */
    function addBtnPrazo($id, $title = false, $selected = 'I', $class = 'sepH_b', $classBtn = '') {
        $ativeI = $selected == 'I' ? 'active btn-info' : '';
        $ativeP = $selected == 'P' ? 'active btn-info' : '';
        if ($title)
            $return .= $this->addLabel($id, $title);
        $return .= $this->addInput('hidden', $id, false, array('value' => $selected, 'class' => 'status'), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_indefinido_' . $id . '" rel="I" class="btn ' . $ativeI . ' ' . $classBtn . '">Por prazo indefinido</button>';
        $return .= '<button type="button" id="btn_parcelado_' . $id . '" rel="P" class="btn ' . $ativeP . ' ' . $classBtn . '">Com término previsto</button>';
        $return .= '</div>';

        $return .= "<script>
                        $('#btn_indefinido_" . $id . "').click(function(){
                            $('#" . $id . "').val('P');
                            $('#btn_parcelado_" . $id . "').removeClass('btn-info');
                            $('#btn_indefinido_" . $id . "').addClass('btn-info');
                        });
                        $('#btn_parcelado_" . $id . "').click(function(){
                            $('#" . $id . "').val('I');
                            $('#btn_indefinido_" . $id . "').removeClass('btn-info');
                            $('#btn_parcelado_" . $id . "').addClass('btn-info');
                        });
                    </script>";
        return $return;
    }

    /**
     *
     * @param string $id
     * @param string $title
     * @param string $selected
     * @param bool $control default=true
     * @return string
     */
    function addNatureza($id, $title = false, $selected = 'C', $class = 'sepH_b', $classBtn = '', $control = true) {
        $ativeA = $selected == 'C' ? 'active blue' : '';
        $ativeI = $selected == 'D' ? 'active red' : '';

        if ($control) {
            $return .= '<div class="control-group">';
        }

        if ($title)
            $return .= $this->addLabel($id, $title, array('class' => 'control-label'));

        if ($control) {
            $return .= '<div class="controls">';
        }
        $return .= $this->addInput('hidden', $id, false, array('value' => $selected), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_receita_' . $id . '" class="btn ' . $ativeA . ' ' . $classBtn . '" rel="C">Receita</button>';
        $return .= '<button type="button" id="btn_despesa_' . $id . '" class="btn ' . $ativeI . ' ' . $classBtn . '" rel="D">Despesa</button>';
        $return .= '</div>';

        $return .= "<script>
                        $('#btn_receita_" . $id . "').click(function(){
                            $('#" . $id . "').val('C');
                            $('#btn_despesa_" . $id . "').removeClass('red');
                            $('#btn_receita_" . $id . "').addClass('blue');
                        });
                        $('#btn_despesa_" . $id . "').click(function(){
                            $('#" . $id . "').val('D');
                            $('#btn_receita_" . $id . "').removeClass('blue');
                            $('#btn_despesa_" . $id . "').addClass('red');
                        });
                    </script>";
        if ($control) {
            $return .= '</div>';
            $return .= '</div>';
        }
        return $return;
    }
    /**
     *
     * @param string $id
     * @param string $title
     * @param string $selected
     * @param bool $control default=true
     * @return string
     */
    function addCreditoDebito($id, $title = false, $selected = 'C', $class = 'sepH_b', $classBtn = '', $control = true) {
        $ativeA = $selected == 'C' ? 'active blue' : '';
        $ativeI = $selected == 'D' ? 'active red' : '';

        if ($control) {
            $return .= '<div class="control-group">';
        }

        if ($title)
            $return .= $this->addLabel($id, $title, array('class' => 'control-label'));

        if ($control) {
            $return .= '<div class="controls">';
        }
        $return .= $this->addInput('hidden', $id, false, array('value' => $selected), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_receita_' . $id . '" class="btn ' . $ativeA . ' ' . $classBtn . '" rel="C">Crédito</button>';
        $return .= '<button type="button" id="btn_despesa_' . $id . '" class="btn ' . $ativeI . ' ' . $classBtn . '" rel="D">Débito</button>';
        $return .= '</div>';

        $return .= "<script>
                        $('#btn_receita_" . $id . "').click(function(){
                            $('#" . $id . "').val('C');
                            $('#btn_despesa_" . $id . "').removeClass('red');
                            $('#btn_receita_" . $id . "').addClass('blue');
                        });
                        $('#btn_despesa_" . $id . "').click(function(){
                            $('#" . $id . "').val('D');
                            $('#btn_receita_" . $id . "').removeClass('blue');
                            $('#btn_despesa_" . $id . "').addClass('red');
                        });
                    </script>";
        if ($control) {
            $return .= '</div>';
            $return .= '</div>';
        }
        return $return;
    }

    /**
     *
     * @param string $id
     * @param string $title
     * @param string $selected
     * @param bool $control default=true
     * @return string
     */
    function addEmailSMS($id, $title = false, $selected = 'E', $class = 'sepH_b', $classBtn = '', $control = true) {
        $ativeA = $selected == 'E' ? 'active purple' : '';
        $ativeI = $selected == 'S' ? 'active purple' : '';

        if ($control) {
            $return .= '<div class="control-group">';
        }

        if ($title)
            $return .= $this->addLabel($id, $title, array('class' => 'control-label'));

        if ($control) {
            $return .= '<div class="controls">';
        }
        $return .= $this->addInput('hidden', $id, false, array('value' => $selected), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_email_' . $id . '" class="btn ' . $ativeA . ' ' . $classBtn . '" rel="E"><i class="icon-envelope"></i> Email</button>';
        $return .= '<button type="button" id="btn_sms_' . $id . '" class="btn ' . $ativeI . ' ' . $classBtn . '" rel="S"><i class="icon-comment"></i> SMS</button>';
        $return .= '</div>';

        $return .= "<script>
                    $('#btn_email_" . $id . "').click(function(){
                        $('#" . $id . "').val('E').trigger('change');
                        $('#btn_sms_" . $id . "').removeClass('purple');
                        $('#btn_email_" . $id . "').addClass('purple');
                    });
                    $('#btn_sms_" . $id . "').click(function(){
                        $('#" . $id . "').val('S').trigger('change');
                        $('#btn_email_" . $id . "').removeClass('purple');
                        $('#btn_sms_" . $id . "').addClass('purple');
                    });
                    </script>";
        if ($control) {
            $return .= '</div>';
            $return .= '</div>';
        }
        return $return;
    }

    /**
     * Gerar HTML e Javascript para um campo de Hora
     *
     * @param int $id
     * @param string $title
     * @param array $titleParam
     * @param bool $required
     * @param bool $control
     * @return string
     */
    function addDateHourField($id, $title = false, $titleParam = false, $required = false, $control = false) {
        $return = '';
        if ($control) {
            $return .= '<div class="control-group">';
        }

        if ($title) {
            $return .= $this->addLabel($id . '_date', $title, $titleParam);
        }

        if ($control) {
            $return .= '<div class="controls">';
        }
        $req = ($required) ? ';required' : '';

        $paramDate = array('style' => 'width: 75px;', 'class' => 'm-wrap');
        $paramHour = array('style' => 'width: 40px; border-left: 0px none;', 'class' => 'm-wrap');

        $return .= '';
        $return .= $this->addInput('text', $id . '_date', 'Data (' . $title . ')', $paramDate, array('style' => 'display:none'), array('A' => '<label for="' . $id . '_date"><i class="icon-calendar"></i></label>'), false);
        $return .= $this->addInput('text', $id . '_hour', 'Hora (' . $title . ')', $paramHour, array('style' => 'display:none'), array('A' => '<label for="' . $id . '_hour"><i class="icon-time"></i></label>'), false);
        $return .= $this->addInput('hidden', $id, $title, array('validate' => 'dataHora' . $req), array('style' => 'display:none'), false, false);

        if ($control) {
            $return .= '</div></div>';
        }

        $return .= '<script> $(function(){';
        $return .= '
            jQuery("#' . $id . '_hour").timepicker({showMeridian: false}).on("hide.timepicker", function(e) {
                jQuery("#' . $id . '").val(jQuery("#' . $id . '_date").val()+" "+jQuery("#' . $id . '_hour").val());
            });';
        $return .= '
            jQuery("#' . $id . '_date").datepicker({format: "dd/mm/yyyy",autoclose:true,language:"pt-BR"}).on("changeDate", function(ev){
                jQuery("#' . $id . '").val(jQuery("#' . $id . '_date").val()+" "+jQuery("#' . $id . '_hour").val());

                jQuery("#' . $id . '_date").datepicker("hide");
                jQuery("#' . $id . '_hour").focus();
            });
            jQuery("#' . $id . '_hour").on("blur", function() {
                jQuery("#' . $id . '").val(jQuery("#' . $id . '_date").val()+" "+jQuery("#' . $id . '_hour").val());
             });
            ';

        $return .= 'jQuery("#' . $id . '_hour").mask("99:99");';
        $return .= 'jQuery("#' . $id . '_date").mask("99/99/9999");';
        $return .= '}); </script>';
        return $return;
    }

    /**
     *
     * @param type $id
     * @param type $title
     * @param type $selected
     * @return string
     */
    function addVivoMorto($id, $title = false, $selected = 'N', $class = 'sepH_b', $classBtn = '') {
        $ativeA = $selected == 'N' ? 'active green' : '';
        $ativeI = $selected == 'S' ? 'active red' : '';
        if ($title)
            $return .= $this->addLabel($id, $title);

        $return .= $this->addInput('hidden', $id, false, array('value' => $selected), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_vivo_' . $id . '" rel="N" class="btn ' . $ativeA . ' ' . $classBtn . ' ' . $id . '">Vivo</button>';
        $return .= '<button type="button" id="btn_morto_' . $id . '" rel="S" class="btn ' . $ativeI . ' ' . $classBtn . ' ' . $id . '">Óbito</button>';
        $return .= '</div>';

        $return .= "<script>
                        $('#btn_vivo_" . $id . "').click(function(){
                            $('#" . $id . "').val('N');
                            $('#btn_morto_" . $id . "').removeClass('red');
                            $('#btn_vivo_" . $id . "').addClass('green');
                        });
                        $('#btn_morto_" . $id . "').click(function(){
                            $('#" . $id . "').val('S');
                            $('#btn_vivo_" . $id . "').removeClass('green');
                            $('#btn_morto_" . $id . "').addClass('red');
                        });
                    </script>";
        return $return;
    }

        /**
     *
     * @param string $id
     * @param bool $title = false
     * @param string $selected default = 'S'
     * @param string $class default = 'sepH_b'
     * @param string $classBtn default = ''
     * @param bool $control default=true
     * @return string
     */
    function addPendente($id, $title = false, $selected = 'S', $class = 'sepH_b', $classBtn = '', $control = true) {
        $ativeA = $selected == 'S' ? 'active red' : '';
        $ativeI = $selected == 'N' ? 'active green' : '';

        if ($control) {
            $return .= '<div class="control-group">';
        }

        if ($title) {
            $return .= $this->addLabel($id, $title);
        }
        $return .= $this->addInput('hidden', $id, false, array('value' => $selected), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_sim_' . $id . '" rel="S" class="btn ' . $ativeA . ' ' . $classBtn . '">Sim</button>';
        $return .= '<button type="button" id="btn_nao_' . $id . '" rel="N" class="btn ' . $ativeI . ' ' . $classBtn . '">Não</button>';
        $return .= '</div>';

        $return .= "<script>
                        $('#btn_sim_" . $id . "').click(function(){
                            $('#" . $id . "').val('S');
                            $('#btn_nao_" . $id . "').removeClass('green');
                            $('#btn_sim_" . $id . "').addClass('red');
                        });
                        $('#btn_nao_" . $id . "').click(function(){
                            $('#" . $id . "').val('N');
                            $('#btn_sim_" . $id . "').removeClass('red');
                            $('#btn_nao_" . $id . "').addClass('green');
                        });
                    </script>";
        if ($control) {
            $return .= '</div>';
        }
        return $return;
    }

    /**
     *
     * @param string $id
     * @param bool $title = false
     * @param string $selected default = 'P'
     * @param string $class default = 'sepH_b'
     * @param string $classBtn default = ''
     * @param bool $control default=true
     * @return string
     */
    function addTipoProcedimento($id, $title = false, $selected = 'PRO', $class = 'sepH_b', $classBtn = '', $control = true) {
        $ativeP = $selected == 'PRO' ? 'active blue' : '';
        $ativeM = $selected == 'MED' ? 'active blue' : '';
        $ativeF = $selected == 'FLU' ? 'active blue' : '';

        if ($control) {
            $return .= '<div class="control-group">';
        }

        if ($title) {
            $return .= $this->addLabel($id, $title);
        }
        $return .= $this->addInput('hidden', $id, false, array('value' => $selected), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_procedimento_' . $id . '" rel="PRO" class="btn ' . $ativeP . ' ' . $classBtn . '">Procedimento</button>';
        $return .= '<button type="button" id="btn_medicamento_' . $id . '" rel="MED" class="btn ' . $ativeM . ' ' . $classBtn . '">Medicamento</button>';
        $return .= '<button type="button" id="btn_fluidoterapia_' . $id . '" rel="FLU" class="btn ' . $ativeF . ' ' . $classBtn . '">Fluidoterapia</button>';
        $return .= '</div>';

        $return .= "<script>
                        $('#btn_procedimento_" . $id . "').click(function(){
                            $('#" . $id . "').val('PRO');
                            $('#btn_medicamento_" . $id . "').removeClass('blue');
                            $('#btn_fluidoterapia_" . $id . "').removeClass('blue');
                            $('#btn_procedimento_" . $id . "').addClass('blue');
                        });
                        $('#btn_medicamento_" . $id . "').click(function(){
                            $('#" . $id . "').val('MED');
                            $('#btn_procedimento_" . $id . "').removeClass('blue');
                            $('#btn_fluidoterapia_" . $id . "').removeClass('blue');
                            $('#btn_medicamento_" . $id . "').addClass('blue');
                        });
                        $('#btn_fluidoterapia_" . $id . "').click(function(){
                            $('#" . $id . "').val('FLU');
                            $('#btn_procedimento_" . $id . "').removeClass('blue');
                            $('#btn_medicamento_" . $id . "').removeClass('blue');
                            $('#btn_fluidoterapia_" . $id . "').addClass('blue');
                        });
                    </script>";
        if ($control) {
            $return .= '</div>';
        }
        return $return;
    }

    /**
     *
     * @param string $id
     * @param bool $title = false
     * @param string $selected default = 'P'
     * @param string $class default = 'sepH_b'
     * @param string $classBtn default = ''
     * @param bool $control default=true
     * @return string
     */
    function addFrequenciaProcedimento($id, $title = false, $selected = 'REC', $class = 'sepH_b', $classBtn = '', $control = true, $idForm = '') {
        $ativeR = $selected == 'REC' ? 'active purple' : '';
        $ativeU = $selected == 'UMA' ? 'active purple' : '';
        $ativeN = $selected == 'NEC' ? 'active purple' : '';

        if ($control) {
            $return .= '<div class="control-group">';
        }

        if ($title) {
            $return .= $this->addLabel($id, $title);
        }
        $return .= $this->addInput('hidden', $id, false, array('value' => $selected), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_recorrente_' . $id . '" rel="REC" class="btn ' . $ativeR . ' ' . $classBtn . '">Recorrente</button>';
        $return .= '<button type="button" id="btn_umavez_' . $id . '" rel="UMA" class="btn ' . $ativeU . ' ' . $classBtn . '">Apenas 1 vez</button>';
        $return .= '<button type="button" id="btn_necessario_' . $id . '" rel="NEC" class="btn ' . $ativeN . ' ' . $classBtn . '">Quando Necessário</button>';
        $return .= '</div>';

        $return .= "<script>
                        $('" . $idForm . " #btn_recorrente_" . $id . "').click(function(){
                            $('" . $idForm . " #" . $id . "').val('REC');
                            $('" . $idForm . " #btn_umavez_" . $id . "').removeClass('purple');
                            $('" . $idForm . " #btn_necessario_" . $id . "').removeClass('purple');
                            $('" . $idForm . " #btn_recorrente_" . $id . "').addClass('purple');
                        });
                        $('" . $idForm . " #btn_umavez_" . $id . "').click(function(){
                            $('" . $idForm . " #" . $id . "').val('UMA');
                            $('" . $idForm . " #btn_recorrente_" . $id . "').removeClass('purple');
                            $('" . $idForm . " #btn_necessario_" . $id . "').removeClass('purple');
                            $('" . $idForm . " #btn_umavez_" . $id . "').addClass('purple');
                        });
                        $('#btn_necessario_" . $id . "').click(function(){
                            $('" . $idForm . " #" . $id . "').val('NEC');
                            $('" . $idForm . " #btn_recorrente_" . $id . "').removeClass('purple');
                            $('" . $idForm . " #btn_umavez_" . $id . "').removeClass('purple');
                            $('" . $idForm . " #btn_necessario_" . $id . "').addClass('purple');
                        });
                    </script>";
        if ($control) {
            $return .= '</div>';
        }
        return $return;
    }

    /**
     *
     * @param string $id
     * @param string $title
     * @param string $selected
     * @param bool $control default=true
     * @return string
     */
    function addNascimentoAniversario($id, $title = false, $selected = 'N', $class = 'sepH_b', $classBtn = '', $control = true, $ajuda = '', $ajudapos = 'top')
    {
        $ativeA = $selected == 'N' ? 'active purple' : '';
        $ativeI = $selected == 'S' ? 'active purple' : '';

        if ($control) {
            $return .= '<div class="control-group aniversarionascimento">';
        }

        if ($title)
            $return .= $this->addLabel($id, $title);

        $return .= $this->addInput('hidden', $id, false, array('value' => $selected), false, false, false);
        $return .= '<div id="' . $id . '_group" data-toggle="buttons-radio" class="btn-group btnChave clearfix ' . $class . '">';
        $return .= '<button type="button" id="btn_aniversario_' . $id . '" class="btn ' . $ativeA . ' ' . $classBtn . '" rel="N">Somente aniversário</button>';
        $return .= '<button type="button" id="btn_nascimento_' . $id . '" class="btn ' . $ativeI . ' ' . $classBtn . '" rel="S">Data de nascimento</button>';

        $return .= '</div>';

        if ($ajuda != '') {
            $return .= getSuporte($ajuda, $ajudapos, false);
        }

        $return .= "<script>
                        $('#btn_aniversario_" . $id . "').click(function(){
                            $('#" . $id . "').val('N');
                            $('#btn_nascimento_" . $id . "').removeClass('purple');
                            $('#btn_aniversario_" . $id . "').addClass('purple');
                        });
                        $('#btn_nascimento_" . $id . "').click(function(){
                            $('#" . $id . "').val('S');
                            $('#btn_aniversario_" . $id . "').removeClass('purple');
                            $('#btn_nascimento_" . $id . "').addClass('purple');
                        });
                    </script>";
        if ($control) {
            $return .= '</div>';
        }
        return $return;
    }

}