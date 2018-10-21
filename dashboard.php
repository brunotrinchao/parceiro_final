<?php
	include_once('./config.php');
	if(!$session){
		header('Location: ' . URL_SYS);
	}

	$inicial = new Inicial('teste', 'tt', 't');
	$inicial->getHeader();
	include_once('./inc/sidebar.php');
	include_once('./inc/bar_top.php');

	$sessao_json =  json_encode($_SESSION["sc_portal"]);
	$tipo_cliente = ($_GET['tipo_cliente'])? $_GET['tipo_cliente'] : 'undefined';
	
?>
<script>
	
	window.sessao_json = <?php echo $sessao_json ?>;
	window.tipo_cliente = <?php echo $tipo_cliente ?>;
</script>

<?php goUrl(); ?>
<?php include_once('./pages/dashboard.php'); ?>
<?php
$inicial->getFooter();
?>