<?php


error_reporting(0);
ini_set("display_errors", "0");
ini_set("log_errors", 0);


session_start();
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/class/autoload.php';

include('functions.php');


// $session = verificaSessao($_SESSION);

$doc_root = ($_SERVER['SERVER_NAME'] == 'localhost')? $_SERVER['DOCUMENT_ROOT'] . '/parceiros_final/': $_SERVER['DOCUMENT_ROOT'];

$base_url = ($_SERVER['SERVER_NAME'] == 'localhost')? 'http://localhost/parceiros_final/': 'http://brunotrinchao.000webhostapp.com/';

define('ROOT',$doc_root);
define('ROOT_SYS', dirname(__FILE__));
//Constantes caminho absoluto
define('ROOT_SYS_CLASS', ROOT_SYS . '/_class/');

define('URL_SYS', $base_url);
define('ROOT_SYS_ASSETS', URL_SYS . '_assets/');


$autoload = new Autoload();