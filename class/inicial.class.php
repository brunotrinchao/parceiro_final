<?php   



class Inicial{

    private $titulo;
    private $subtitulo;
    private $complementoTopo;
    private $_libs;
    private $_defult;
    private $_sidebar;

    public function __construct($titulo, $subtitulo = '', $complementoTopo = '')
    {
        $this->titulo = strip_tags($titulo);
        $this->subtitulo = (strip_tags($subtitulo))? ' | ' . strip_tags($subtitulo): '';
        $this->complementoTopo = $complementoTopo;

        $this->_defult = ['jquery', 'bootstrap', 'default', 'sweetalert2', 'scripts'];

        $this->_libs = $this->libDefault();
    }

    function getHeader(){
        $html = '<!DOCTYPE HTML>';
        $html .= '<html>';
        $html .= '<head>';
        $html .= '<title>'.$this->titulo.$this->subtitulo.' </title>';
        $html .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
        $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $html .= '<link href="'.URL_SYS.'_assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />';
        $html .= '<link href="'.URL_SYS.'_assets/css/style.css" rel="stylesheet" type="text/css" />';
        $html .= '<link href="'.URL_SYS.'_assets/css/font-awesome.css" rel="stylesheet">';
        $html .= '<link rel="stylesheet" href="'.URL_SYS.'_assets/css/icon-font.min.css" type="text/css" />';
        $html .= '<link href="'.URL_SYS.'_assets/css/animate.css" rel="stylesheet" type="text/css" media="all">';
        $html .= '<link href="//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic" rel="stylesheet" type="text/css">';
        $html .= '<link rel="stylesheet" href="'.URL_SYS.'_assets/js/plugins/sweetalert2/sweetalert2.min.css">';
        $html .= '<link rel="stylesheet" href="'.URL_SYS.'_assets/js/plugins/pagination/simplePagination.css">';
        $html .= '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />';
        $html .= '<link href="'.URL_SYS.'_assets/css/geral.min.css" rel="stylesheet" type="text/css" />';
        $html .= '<script src="'.URL_SYS.'_assets/js/jquery-1.10.2.min.js"></script>';
        $html .= '</head>';
        $html .= '<body class="sticky-header">';
        $html .= '<section>';
        echo $html;
        
    }

    function getFooter(){
        $html = '</div>';
        $html .= '</section>';
        $html .= '<footer>';
        $html .= '<p>Todos os direitos reservados</p>';
        $html .= '</footer>';
        $html .= '<script src="'.URL_SYS.'_assets/js/jquery.nicescroll.js"></script>';
        $html .= '<script src="'.URL_SYS.'_assets/js/bootstrap.min.js"></script>';
        $html .= '<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>';
        $html .= '<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>';
        $html .= '<script src="'.URL_SYS.'_assets/js/plugins/sweetalert2/sweetalert2.all.min.js"></script>';
        $html .= '<script src="'.URL_SYS.'_assets/js/jquery.mask.js"></script>';
        $html .= '<script src="'.URL_SYS.'_assets/js/plugins/jquery.autocomplete-address.min.js"></script>';
        $html .= '<script src="'.URL_SYS.'_assets/js/functions/functions.js"></script>';
        $html .= '<script src="'.URL_SYS.'_assets/js/functions/gValidate.js"></script>';
        $html .= '<script src="'.URL_SYS.'_assets/js/plugins/bootpag.min.js"></script>';
        $html .= '<script src="'.URL_SYS.'_assets/js/functions/api.js"></script>';
        $html .= '<script src="'.URL_SYS.'_assets/js/scripts.js"></script>';
        $html .= '</body>';
        $html .= '</html>';
        $html .= '</div>';
        $html .= '</div>';
        echo $html;
    }



    function addLib($bibliotecas) {
        foreach ($bibliotecas as $bib) {
            if ($bib != '') {
                $arquivos = $this->_libs[$bib];
                foreach ($arquivos as $arq) {
                    $tipo = explode(".", $arq);
                    if (strpos($tipo[count($tipo) - 1], 'css') === 0) {
                        $this->addCSS($arq);
                    } else if (strpos($tipo[count($tipo) - 1], 'js') === 0) {
                        $this->addScript($arq);
                    } else if ($tipo[count($tipo) - 1] == 'php') {
                        require_once $arq;
                    }
                }
            }
        }
    }

    private function mountJs(){
        $html = '';
        foreach($this->_defult as $item){
            foreach($this->_libs[$item] as $value){
                if(strpos($value, '.js')){
                    $html .= '<script src="'.$value.'"></script>' . chr(10);
                }
            }
        }
        return $html;
    }
    private function mountCss(){
        $html = '';
        foreach($this->_defult as $item){
            foreach($this->_libs[$item] as $value){
                if(strpos($value, '.css')){
                    $html .= '<link href="'.$value.'">' . chr(10);
                }
            }
        }
        return $html;
    }


    private function libDefault(){
        $ret = [
            'jquery' => [
                ROOT_SYS_ASSETS . 'js/jquery-1.10.2.min.js'
            ],
            'default' => [
                ROOT_SYS_ASSETS . 'css/style.css',
                ROOT_SYS_ASSETS . 'css/font-awesome.css',
                ROOT_SYS_ASSETS . 'css/icon-font.min.css',
                ROOT_SYS_ASSETS . 'css/animate.css',
            ],
            'bootstrap' => [
                ROOT_SYS_ASSETS . 'js/bootstrap.min.js',
                '_assets/css/bootstrap.min.css'
            ],
            'sweetalert2' => [
                ROOT_SYS_ASSETS . 'js/plugins/sweetalert2/sweetalert2.min.css',
                ROOT_SYS_ASSETS . 'js/plugins/sweetalert2/sweetalert2.all.min.js'
            ],
            'scripts' => [
                ROOT_SYS_ASSETS . 'js/scripts.js',
                ROOT_SYS_ASSETS . 'js/functions/functions.js',
                ROOT_SYS_ASSETS . 'js/functions/api.js',
            ],
        ];
        return $ret;
    }

}