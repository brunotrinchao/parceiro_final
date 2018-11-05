<?php

$htmlForm .= $form->addInput('hidden', 'idProdutoIndicacao', null, array('value'=> $produto_id), false, false, true);
$htmlForm .= $form->addInput('hidden', 'idTipoBem', null, array('value'=> $tipo_consorcio), false, false, true);
$htmlForm .= '<div class="panel panel-default">';
$htmlForm .= '<div class="panel-heading">Informações da indicação</div>';
$htmlForm .= '<div class="panel-body">';
$htmlForm .= '<div class="row">';
$htmlForm .= '<div class="col-md-3">';
$htmlForm .= $form->addInput('text', 'ValorBem', 'Valor do bem*', array('class' => 'form-control moeda', 'autocomplete' => 'off'), false, false, true);
$htmlForm .= '</div>';
$htmlForm .= '<div class="col-md-12">';
$htmlForm .= $form->addTextarea('Observacao', '', 'Observação', array('class' => 'form-control'), false, false, true);
$htmlForm .= '</div>';
$htmlForm .= '</div>';
$htmlForm .= '</div>';
$htmlForm .= '</div>';