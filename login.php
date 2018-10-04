<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;

$body = json_decode(file_get_contents("php://input"), true);

$curl = new Curl();
$curl->setOpt(CURLOPT_ENCODING , '');
$curl->setHeader('Authorization', 'YnJ1bm86SW50ZWdyYWNhb1BhcmNlaXJvcw==');
$curl->setHeader('Content-Type', 'application/json');
$curl->get('http://integracaogtsis.tempsite.ws/api/Parceiros/Usuarios/'.$body['login'].'/'.$body['senha']);

$return = [];
$return['code'] = $curl->getHttpStatusCode();
if ($curl->error) {
    $return['msg'] = 'Erro ao efetuar login!';
} else {
    $return['msg'] = 'Login efetuado com sucesso!';
    $return['data'] = (array)$curl->response;

    $_SESSION['sc_portal'] = (array)$curl->response;
}

echo json_encode($return);

