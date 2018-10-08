<?php

function verificaSessao($session){
    if(isset($session['sc_portal'])){
        if($session['sc_portal'] != NULL && $session['sc_portal']['Bloqueado'] == false){
            return true;
        }
    }
    return false;
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
                        'id' => 1,
                        "nome" => "Interessado",
                        "url" => null,
                    ]
                    ],
                'submenu' => [
                    [
                        'nome' => 'Comprar/Alugar',
                        'url' => 'indicar'
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

