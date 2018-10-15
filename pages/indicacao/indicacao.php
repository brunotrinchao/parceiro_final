<?php
$htmlForm = '';
$form = new Form();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
$htmlForm .= $form->open('formNovaIndicacao', 'form-vertical form');
$htmlForm .= $form->addInput('hidden', 'acao', false, array('value' => 'ins', 'class' => 'acao'), false, false, false);
$htmlForm .= $form->addInput('hidden', 'idUsuarioParceiro', false, array('value' => $_SESSION['sc_portal']['id'], 'class' => 'acao'), false, false, false);

include('cliente_form.php');
include('imovel_form.php');
$htmlForm .= '<div style="clear:both">';
$htmlForm .= '<button type="submit" class="btn btn-primary pull-right">Cadastrar</button>';
$htmlForm .= '</div>';
$htmlForm .= $form->close();

echo $htmlForm;