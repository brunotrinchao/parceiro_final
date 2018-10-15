<?php
	include_once('./config.php');
	if(!$session){
		header('Location: ' . URL_SYS);
	}

	$inicial = new Inicial('teste', 'tt', 't');
	$inicial->getHeader();
	include_once('./inc/sidebar.php');
	include_once('./inc/bar_top.php');
?>
<h3 class="blank1">Nova indicação</h3>
<?php include_once('./pages/indicacao/indicacao.php'); ?>
<?php
$inicial->getFooter();
?>