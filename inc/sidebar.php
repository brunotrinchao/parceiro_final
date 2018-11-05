<?php
if(!$verificaSession){
    header('Location: ' . URL_SYS);
}

$sessao =  $_SESSION["sc_portal"];

$sessao_json =  json_encode($_SESSION["sc_portal"]);
$tipo_cliente = ($_GET['tipo_cliente'])? $_GET['tipo_cliente'] : 'undefined';
$tipo_financiamento = ($_GET['tipo_financiamento'])? $_GET['tipo_financiamento'] : 'undefined';
$tipo_consorcio = ($_GET['tipo_consorcio'])? $_GET['tipo_consorcio'] : 'undefined';
?>

<script>
	
	window.sessao_json = <?php echo $sessao_json ?>;
    window.tipo_cliente = <?php echo $tipo_cliente ?>;
    window.tipo_financiamento = <?php echo $tipo_financiamento ?>;
    window.id_produto = <?php echo $produto_id ?>;
    window.url_sys = encodeURI("<?php echo URL_SYS ?>");
</script>
<!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <h1><a href="index.html">SUPER<span>CRÉDITO</span></a></h1>
        </div>
        <div class="logo-icon text-center">
        <h1><a href="index.html">S<span>C</span></a></h1>
        </div>

        <!--logo and iconic logo end-->
        <div class="left-side-inner">
				<?php
					$menu_sidebar = menuGenerator($produto_id);
				?>
            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li class="active"><a href="index.html"><i class="lnr lnr-power-switch"></i><span>Dashboard</span></a></li>
                <?php
                    if($menu_sidebar){
                        foreach ($menu_sidebar['menu'] as $key_menu => $value_menu) {
                            echo '<li class="menu-list">';
                            echo '<a href="#"><i class="lnr lnr-cog"></i>';
                            echo '<span>'.$value_menu['nome'].'</span></a>';
                            echo '<ul class="sub-menu-list">';
                            foreach ($menu_sidebar['submenu'] as $key_submenu => $value_submenu) {
                                echo '<li><a href="'.URL_SYS.$value_submenu['url'].$value_menu['id'].'">'.$value_submenu['nome'].'</a> </li>';
                            }
                            echo '</ul>';
                            echo '</li>';
                        }
                    }
                ?>
                <?php
                    if($sessao['EhMaster']){
                ?>
                <li class="menu-list">
                    <a href="#"><i class="lnr lnr-cog"></i>
                        <span>Administração</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo URL_SYS; ?>pag/adm/produtos.php">Produtos</a> </li>
                    </ul>
                </li>
                <?php
                    }
                ?>
               <!--  <li><a href="forms.html"><i class="lnr lnr-spell-check"></i> <span>Forms</span></a></li>
                <li><a href="tables.html"><i class="lnr lnr-menu"></i> <span>Tables</span></a></li>
                <li class="menu-list"><a href="#"><i class="lnr lnr-envelope"></i> <span>MailBox</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="inbox.html">Inbox</a> </li>
                        <li><a href="compose-mail.html">Compose Mail</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href="#"><i class="lnr lnr-indent-increase"></i> <span>Menu Levels</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="charts.html">Basic Charts</a> </li>
                    </ul>
                </li>
                <li><a href="codes.html"><i class="lnr lnr-pencil"></i> <span>Typography</span></a></li>
                <li><a href="media.html"><i class="lnr lnr-select"></i> <span>Media Css</span></a></li>
                <li class="menu-list"><a href="#"><i class="lnr lnr-book"></i> <span>Pages</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="sign-in.html">Sign In</a> </li>
                        <li><a href="sign-up.html">Sign Up</a></li>
                        <li><a href="blank_page.html">Blank Page</a></li>
                    </ul>
                </li> -->
            </ul>
            <!--sidebar nav end-->
        </div>
    </div>
    <!-- left side end-->