<?php
    include_once('../../config.php');
    $produto_id = 1;
	$inicial = new Inicial(TITULO_DEFAULT, 'Adminitrar Produtos', '');
	$inicial->getHeader();
	include_once('../../inc/sidebar.php');
	include_once('../../inc/bar_top.php');


echo "<h3 class=\"blank1\">Administrar <br><small>Produtos</small></h3>";

$htmlForm = '';
$form = new Form();
$htmlForm .= $form->open('formEditarprodutos', 'form-vertical form');
$htmlForm .= $form->addInput('hidden', 'imagemBase64', false, array('class' => 'acao'), false, false, false);
$htmlForm .= '<div class="row">';
$htmlForm .= '<div class="col-md-3">';
$htmlForm .= $form->addSelect('id', array(), '-1', 'Produto', array('validate' => 'required', 'class' => 'form-control select2'), false, false, true, '', 'Selecione...', true, true) ;
$htmlForm .= '</div>';
$htmlForm .= '<div class="col-md-3">';
$htmlForm .= $form->addSelect('ativo', array('true' => 'Ativo', 'false' => 'Inativo'), '1', 'Status', array('validate' => 'required', 'class' => 'form-control select2', 'disabled' => 'disabled'), false, false, true, '', 'Selecione...', true, true) ;
$htmlForm .= '</div>';
$htmlForm .= '<div class="col-md-5">';
$htmlForm .= $form->addInput('file', 'imagem', 'Imagem*', array('class' => 'form-control', 'autocomplete' => 'off', 'disabled' => 'disabled'), false, false, true);
$htmlForm .= '</div>';
$htmlForm .= '</div>';
$htmlForm .= '<div class="row">';
$htmlForm .= '<div class="col-md-3">';
$htmlForm .= $form->addInput('text', 'titulo', 'Titulo*', array('validate' => 'required', 'class' => 'form-control', 'autocomplete' => 'off', 'disabled' => 'disabled'), false, false, true);
$htmlForm .= '</div>';
$htmlForm .= '<div class="col-md-3">';
$htmlForm .= $form->addInput('text', 'subTitulo', 'Subtítulo', array('class' => 'form-control', 'autocomplete' => 'off', 'disabled' => 'disabled'), false, false, true);
$htmlForm .= '</div>';
$htmlForm .= '<div class="col-md-3">';
$htmlForm .= $form->addInput('text', 'url', 'Url', array('class' => 'form-control', 'autocomplete' => 'off', 'disabled' => 'disabled'), false, false, true);
$htmlForm .= '</div>';
$htmlForm .= '</div>';
$htmlForm .= '<div style="clear:both">';
$htmlForm .= '<button type="submit" class="btn btn-primary pull-right">Atualizar</button>';
$htmlForm .= '</div>';
$htmlForm .= $form->close();

echo $htmlForm;



$inicial->getFooter();
?>

<script>
    $(document).ready(function(){
        listaProdutos();   
    });
</script>




