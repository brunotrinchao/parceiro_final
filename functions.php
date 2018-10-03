<?php
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
