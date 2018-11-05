<?php
include_once './config.php';

$verifica_logado = ($_SESSION['sc_portal'])? true:false;;
$logado = ($verifica_logado)? 'logado' : '';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title><?php echo TITULO_DEFAULT; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URL_SYS ?>_assets/plugins/bootstrap/css/bootstrap.min.css">
    <link href="<?php echo URL_SYS ?>_assets/css/geral.min.css" rel="stylesheet">
    <script>
        var url_sys = "<?php echo URL_SYS; ?>";
    </script>
</head>

<body id="home" class="<?php echo $logado; ?>">
    <!-- Banner -->
    <div class="banner">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-12 col-md-4 col-sm-8 logo">
                    <img src="<?php echo URL_SYS ?>_assets/img/logo_branca.png" alt="" class="">
                </div>
                <div class="col-12 col-md-8 col-sm-4">
                    <?php
                        if($verifica_logado){
                    ?>
                        <div class="text-right">
                            <h6><span class="text-light"><?php echo $_SESSION['sc_portal']['Nome'] ?></span> <a href="#" class="btn btn-link">Sair</a></h6>
                        </div>
                    <?php
                        }else{
                    ?>
                    <form id="login" action="" class="form-inline float-right">
                    <div class="row">
                        <div class="col-12 col-sm-5 mb-2">
                        <input type="text" name="login" class="form-control form-control-sm" placeholder="login" value="domicio.imoveis">
                        </div>
                        <div class="col-12 col-sm-5 mb-2">
                        <input type="password" name="senha" class="form-control form-control-sm" placeholder="senha" value="dom0734">
                        </div>
                        <div class="col-12 col-sm-2 mb-2">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">OK</button>
                        </div>
                    </div>
                    </form>
                    <?php
                        }
                    ?>
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
        </div>
    </div>
    </div>

</body>
<script src="<?php echo URL_SYS ?>_assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo URL_SYS ?>_assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo URL_SYS ?>_assets/js/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo URL_SYS ?>_assets/js/functions/functions.js"></script>
<script src="<?php echo URL_SYS ?>_assets/js/functions/api.js"></script>
<script src="<?php echo URL_SYS ?>_assets/js/home/script.js"></script>

</html>