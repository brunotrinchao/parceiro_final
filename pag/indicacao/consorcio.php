<?php
    include_once('../../config.php');
    verificaSessao($_SESSION);
    $produto_id = 3;
	$inicial = new Inicial('teste', 'tt', 't');
	$inicial->getHeader();
	include_once('../../inc/sidebar.php');
	include_once('../../inc/bar_top.php');

	$sessao_json =  json_encode($_SESSION["sc_portal"]);
	$tipo_cliente = ($_GET['tipo_cliente'])? $_GET['tipo_cliente'] : 'undefined';

?>
<script>
	
	window.sessao_json = <?php echo $sessao_json ?>;
    window.tipo_cliente = <?php echo $tipo_cliente ?>;
    
</script>
<?php

if($tipo_cliente == 'undefined'){
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




