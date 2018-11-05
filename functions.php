<?php

function verificaSessao($session){
    if(isset($session['sc_portal'])){
        if($session['sc_portal']['Bloqueado'] == false){
            return true;
        }else{
            header("location:".URL_SYS);
        }
    }else{
        header("location:".URL_SYS);
    }
}

function verificaAdmin($data){
	if(!$data){
		header("location:".URL_SYS . "pag/block.php");
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
                        // 'nome' => 'Comprar/Alugar',
                        'nome' => 'Indicar',
                        'url' => 'pag/indicacao/imovel.php?tipo_cliente='
                    ],
                    [
                        'nome' => 'Gerenciar',
                        'url' => 'pag/indicacao/imovel_gerenciar.php?tipo_cliente='
                    ]
                ]
            ];
            return $arrayMenu;
            break;
        case 3:
            $arrayMenu = [
                'titulo' => "Financiamento",
                'menu' => [
                    [
                        'id' => 1,
                        "nome" => "Auto",
                        "url" => null,
                    ],
                    [
                        'id' => 2,
                        "nome" => "Imóvel",
                        "url" => null,
                    ]
                    ],
                'submenu' => [
                    [
                        'nome' => 'Indicar',
                        'url' => 'pag/indicacao/consorcio.php?tipo_consorcio='
                    ],
                    [
                        'nome' => 'Gerenciar',
                        'url' => 'pag/indicacao/consorcio_gerenciar.php?tipo_consorcio='
                    ]
                ]
            ];
            return $arrayMenu;
            break;
        case 2:
            $arrayMenu = [
                'titulo' => "Financiamento",
                'menu' => [
                    [
                        'id' => 1,
                        "nome" => "Tradicional",
                        "url" => null,
                    ],
                    [
                        'id' => 2,
                        "nome" => "Refinanciamento",
                        "url" => null,
                    ]
                    ],
                'submenu' => [
                    [
                        'nome' => 'Indicar',
                        'url' => 'pag/indicacao/financiamento.php?tipo_financiamento='
                    ],
                    [
                        'nome' => 'Gerenciar',
                        'url' => 'pag/indicacao/financiamento_gerenciar.php?tipo_financiamento='
                    ]
                ]
            ];
            return $arrayMenu;
            break;

        default:
            return null;
            break;
    }
}

