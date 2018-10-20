<?php


error_reporting(0);
ini_set("display_errors", "0");
ini_set("log_errors", 0);


session_start();
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/class/autoload.php';
include('functions.php');

$session = verificaSessao($_SESSION);


define('ROOT',$_SERVER['DOCUMENT_ROOT']);
define('ROOT_SYS', dirname(__FILE__));
//Constantes caminho absoluto
define('ROOT_SYS_CLASS', ROOT_SYS . '/_class/');

define('URL_SYS', 'http://localhost:3000/');
define('ROOT_SYS_ASSETS', URL_SYS . '_assets/');


$autoload = new Autoload();
