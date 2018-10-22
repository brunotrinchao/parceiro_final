<?php
    include_once('../../config.php');
    verificaSessao($_SESSION);
    $produto_id = 1;
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
    window.id_produto = <?php echo $produto_id ?>;
    
</script>
<?php

echo "<h3 class=\"blank1\">Imóvel <br><small>Gerenciar</small></h3>";

$htmlForm = '';
$form = new Form();
$htmlForm .= $form->open('formFiltroIndicacao', 'form-vertical form');
$htmlForm .= $form->addInput('hidden', 'idUsuarioParceiro', false, array('value' => $_SESSION['sc_portal']['id'], 'class' => 'acao'), false, false, false);
$htmlForm .= '<div class="row">';
$htmlForm .= '<div class="col-md-3">';
$htmlForm .= '<div class="control-group">';
$htmlForm .= '<label id="lbl_reportrange" for="reportrange" class=" control-label">Data</label>';
$htmlForm .= '<div class="form-group">';
$htmlForm .= '<div id="reportrange" class="btn btn-default" style="background: #fff; cursor: pointer; width: 100%">';
$htmlForm .= '<i class="fa fa-calendar"></i>&nbsp;';
$htmlForm .= '<span></span> <i class="fa fa-caret-down"></i>';
$htmlForm .= '</div>';
$htmlForm .= $form->addInput('hidden', 'periodo', null, array('class' => 'form-control'), false, false, true);
$htmlForm .= '</div>';
$htmlForm .= '</div>';
$htmlForm .= '</div>';
// Tabela
$htmlForm .= '<div class="row">';
$htmlForm .= '<div id="tabela" class="col-md-12">';
$htmlForm .= '<table class="table table-striped table-bordered">';
$htmlForm .= '<tr>';
$htmlForm .= '<td>Nome</td>';
$htmlForm .= '<td>Telefone</td>';
$htmlForm .= '<td>E-mail</td>';
$htmlForm .= '<td>Status</td>';
$htmlForm .= '</tr>';
$htmlForm .= '</table>';
$htmlForm .= '</div>';
$htmlForm .= '</div>';

$htmlForm .= '<div class="row">';
$htmlForm .= '<div id="paginacao" class="col-md-12">';
$htmlForm .= '</div>';
$htmlForm .= '</div>';

echo $htmlForm;

$inicial->getFooter();
?>




