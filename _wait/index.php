<?php 
 include_once './config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URL ?>_assets/plugins/bootstrap/css/bootstrap.min.css">
    <link href="<?php echo URL ?>_assets/css/geral.min.css" rel="stylesheet">
</head>

<body id="home"  class="logado">
    <!-- Banner -->
    <div class="banner">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-12 col-md-4 col-sm-8 logo">
                    <img src="<?php echo URL ?>_assets/img/logo_branca.png" alt="" class="">
                </div>
                <div class="col-12 col-md-8 col-sm-4">
                    <form action="" class="form-inline float-right">
                    <div class="row">
                        <div class="col-12 col-sm-5 mb-2">
                        <input type="email" class="form-control form-control-sm" placeholder="login">
                        </div>
                        <div class="col-12 col-sm-5 mb-2">
                        <input type="password" class="form-control form-control-sm" placeholder="senha">
                        </div>
                        <div class="col-12 col-sm-2 mb-2">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">OK</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="titulo">
            <h1></h1>
        </div>
    </div>

    <div class="produtos">
    <div class="container" id="menu">
        <div class="row">
            <div class="col col-12 col-md-6">
                <a href="#" rel="IMOVEIS" class="btn_menu btn_produto" style="background-image: url('<?php echo URL ?>_assets/img/img_imovel.jpg');">
                    <h2>Imóvel</h2>
                </a>
            </div>
            <div class="col col-12 col-md-6">
                <a href="#" rel="OI" class="btn_menu btn_produto" style="background-image: url('<?php echo URL ?>_assets/img/img_oi.jpg');">
                    <h2>Oi</h2>
                </a>
            </div>
            <div class="w-100"></div>
            <div class="col col-12 col-md-6">
                <a href="#" rel="FINANCIAMENTO" class="btn_menu btn_produto" style="background-image: url('<?php echo URL ?>_assets/img/img_financiamento.jpg');">
                    <h2>Financiamento</h2>
                </a>
            </div>
            <div class="col col-12 col-md-6">
                <a href="#" rel="CONSULTORIA" class="btn_menu btn_produto" style="background-image: url('<?php echo URL ?>_assets/img/img_consultoria.jpg');">
                    <h2>Consultoria de crédito</h2>
                </a>
            </div>
        </div>
    </div>
    </div>

</body>
<script src="<?php echo URL ?>_assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo URL ?>_assets/plugins/bootstrap/js/bootstrap.min.js"></script>

</html>