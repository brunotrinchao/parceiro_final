<?php

function verificaSessao($session){
    if(isset($session['sc_portal'])){
        if($session['sc_portal']['Bloqueado'] == false){
            return true;
        }else{
            header('Location: ' . URL_SYS);
        }
    }else{
        header('Location: ' . URL_SYS);
    }
}

function debug($array, $print_r = true){
    echo '<pre class="debug">';
    if($print_r){
        print_r($array);
    }else{
        var_dump($array);
    }
    echo '</pre>';
}


function menuGenerator($tipo){

    switch ($tipo) {
        case 1:
            $arrayMenu = [
                'titulo' => "Imovéis",
                'menu' => [
                    [
                        'id' => 1,
                        "nome" => "Proprietário",
                        "url" => null,
                    ],
                    [
                        'id' => 2,
                        "nome" => "Interessado",
                        "url" => null,
                    ]
                    ],
                'submenu' => [
                    [
                        'nome' => 'Comprar/Alugar',
                        'url' => 'pag/indicacao/imovel.php?tipo_cliente='
                    ],
                    [
                        'nome' => 'Gerenciar',
                        'url' => 'listar'
                    ]
                ]
            ];
            return $arrayMenu;
            break;

        default:
            # code...
            break;
    }
}

