<?php
    include_once('../../config.php');
    $produto_id = 3;
	$inicial = new Inicial(TITULO_DEFAULT, 'Consórcio', '');
	$inicial->getHeader();
	include_once('../../inc/sidebar.php');
	include_once('../../inc/bar_top.php');

echo "<h3 class=\"blank1\">Consórcio <br><small>Gerenciar</small></h3>";

$htmlForm = '';
$form = new Form();
$htmlForm .= $form->open('filtrar', 'form-vertical form');
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
$htmlForm .= $form->close();
// Tabela
// $htmlForm .= '<div class="row">';
$htmlForm .= '<div id="tabela" class="col-md-12">';
$htmlForm .= '<div id="container_rows">';
$htmlForm .= '</div>';

$htmlForm .= '</div>';
$htmlForm .= '</div>';
// $htmlForm .= '</div>';

$htmlForm .= '<div class="row">';
$htmlForm .= '<div id="paginacao" class="col-md-12">';
$htmlForm .= '</div>';
$htmlForm .= '</div>';



$htmlForm .= '<div id="modal_detalhes" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">';
$htmlForm .= '<div class="modal-dialog modal-lg" role="document">';
$htmlForm .= '<div class="modal-content">';
$htmlForm .= '<div class="modal-header">';
$htmlForm .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
$htmlForm .= '<h4 class="modal-title" id="myModalLabel">Informações</h4>';
$htmlForm .= '</div>';
$htmlForm .= '<div class="modal-body">';
$htmlForm .= '</div>';
$htmlForm .= '</div>';
$htmlForm .= '</div>';
$htmlForm .= '</div>';

echo $htmlForm;

$inicial->getFooter();
?>
<script>
	$(document).ready(function(){
		getTipoBem();	
	});
</script>