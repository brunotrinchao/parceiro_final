<?php
    include_once('../../config.php');
    $produto_id = 1;
	$inicial = new Inicial(TITULO_DEFAULT, 'Imóvel', '');
	$inicial->getHeader();
	include_once('../../inc/sidebar.php');
	include_once('../../inc/bar_top.php');



    echo "<h3 class=\"blank1\">Acesso negado!</h3>";
$htmlForm = '<p>Acesso permitido apenas para administradores.</p>';

echo $htmlForm;

$inicial->getFooter();
?>




