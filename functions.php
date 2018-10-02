<?php
function menuGenerator($tipo){

    switch ($tipo) {
        case 1:
            $arrayName = array(
                'titulo' => "Imovéis",
                'menu' => [
                    [0] => [
                        'id' => 1,
                        "nome" => "Proprietário",
                        "url" => null,
                    ],
                    [1] => [
                        'id' => 1,
                        "nome" => "Interessado",
                        "url" => null,
                    ]
                ],
                'submenu' => [
                    [0] => [
                        'nome' => 'Comprar/Alugar',
                        'url' => 'indicar'
                    ],
                    [1] => [
                        'nome' => 'Gerenciar',
                        'url' => 'listar'
                    ],
                ]
            );
            break;

        default:
            # code...
            break;
    }

}