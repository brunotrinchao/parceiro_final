<?php

include('./vendor/autoload.php');

$body = json_decode(file_get_contents("php://input"), true);

$curl = new Curl();
$curl->get('https://jsonplaceholder.typicode.com/todos/1');

var_dump($curl->response);

// if ($curl->error) {
//     echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
// } else {
//     echo 'Response:' . "\n";
//     var_dump($curl->response);
// }

