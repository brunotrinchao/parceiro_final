<?php
    include_once('../../config.php');
    $produto_id = 3;
	$inicial = new Inicial(TITULO_DEFAULT, 'Consórcio', '');
	$inicial->getHeader();
	include_once('../../inc/sidebar.php');
	include_once('../../inc/bar_top.php');

if($tipo_consorcio == 'undefined'){
echo "<h3 class=\"blank1\">Consórcio</h3>";
}else{
    echo "<h3 class=\"blank1\">Consórcio <br><small>Nova indicação</small></h3>";
$htmlForm = '';
$form = new Form();
$htmlForm .= $form->open('formNovaIndicacao', 'form-vertical form');
$htmlForm .= $form->addInput('hidden', 'acao', false, array('value' => 'ins', 'class' => 'acao'), false, false, false);
$htmlForm .= $form->addInput('hidden', 'idUsuarioParceiro', false, array('value' => $_SESSION['sc_portal']['id'], 'class' => 'acao'), false, false, false);

include('cliente_form.php');
include('consorcio_form.php');
$htmlForm .= '<div style="clear:both">';
$htmlForm .= '<button type="submit" class="btn btn-primary pull-right">Cadastrar</button>';
$htmlForm .= '</div>';
$htmlForm .= $form->close();

echo $htmlForm;

}

$inicial->getFooter();
?>




