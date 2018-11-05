<?php
    include_once('../../config.php');
    $produto_id = 1;
	$inicial = new Inicial(TITULO_DEFAULT, 'Imóvel', '');
	$inicial->getHeader();
	include_once('../../inc/sidebar.php');
	include_once('../../inc/bar_top.php');


if($tipo_cliente == 'undefined'){
echo "<h3 class=\"blank1\">Imóvel</h3>";
}else{
    echo "<h3 class=\"blank1\">Imóvel <br><small>Nova indicação</small></h3>";
$htmlForm = '';
$form = new Form();
$htmlForm .= $form->open('formNovaIndicacao', 'form-vertical form');
$htmlForm .= $form->addInput('hidden', 'acao', false, array('value' => 'ins', 'class' => 'acao'), false, false, false);
$htmlForm .= $form->addInput('hidden', 'idUsuarioParceiro', false, array('value' => $_SESSION['sc_portal']['id'], 'class' => 'acao'), false, false, false);

include_once('./cliente_form.php');
include_once('./imovel_form.php');
$htmlForm .= '<div style="clear:both">';
$htmlForm .= '<button type="submit" class="btn btn-primary pull-right">Cadastrar</button>';
$htmlForm .= '</div>';
$htmlForm .= $form->close();

echo $htmlForm;

}

$inicial->getFooter();
?>




