<?php

$htmlForm .= $form->addInput('hidden', 'idProdutoIndicacao', null, array('value'=> $produto_id), false, false, true);
$htmlForm .= $form->addInput('hidden', 'idTipoFinanciamento', null, array('value'=> $tipo_financiamento), false, false, true);
$htmlForm .= '<div class="panel panel-default">';
$htmlForm .= '<div class="panel-heading">Informações da indicação</div>';
$htmlForm .= '<div class="panel-body">';
$htmlForm .= '<div class="row">';
$htmlForm .= '<div class="col-md-3">';
$htmlForm .= $form->addSelect('CompraImediata', array('true' => 'Sim', 'false' => 'Não'), '-1', 'Compra imediata*', array('validate' => 'required', 'class' => 'form-control select2'), false, false, true, '', 'Selecione...', true, true) ;
$htmlForm .= '</div>';
$htmlForm .= '<div class="col-md-3">';
$htmlForm .= $form->addSelect('idTipoBem', array(), '-1', 'Tipo do bem*', array('validate' => 'required', 'class' => 'form-control select2'), false, false, true, '', 'Selecione...', true, true) ;
$htmlForm .= '</div>';
$htmlForm .= '<div class="col-md-3">';
$htmlForm .= $form->addInput('text', 'RendaComprovadaFaturamento', 'Renda comprovada*', array('class' => 'form-control moeda', 'autocomplete' => 'off'), false, false, true);
$htmlForm .= '</div>';
$htmlForm .= '<div class="col-md-3">';
$htmlForm .= $form->addInput('text', 'ValorBem', 'Valor do bem*', array('class' => 'form-control moeda', 'autocomplete' => 'off'), false, false, true);
$htmlForm .= '</div>';
$htmlForm .= '<div class="col-md-3">';
$htmlForm .= $form->addInput('text', 'ValorFinanciamento', 'Valor do financiamento*', array('class' => 'form-control moeda', 'autocomplete' => 'off'), false, false, true);
$htmlForm .= '</div>';
$htmlForm .= '</div>';
$htmlForm .= '</div>';
$htmlForm .= '</div>';