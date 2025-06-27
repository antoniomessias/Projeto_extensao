<?php
define('ROOT_PATH', dirname(__DIR__, 2));
define("BASE_URL", "/Projeto_extensao/");
require(ROOT_PATH . '/config/config.php');

class Home
{
    public function index()
    {
        $page_title = 'Bem-vindo à AgroSuaçuna';
        $page_css = BASE_URL . 'assets/CSS/home.css';

        require('app/Views/topo.php');
        require('app/Views/home.php');
        require('app/Views/rodape.php');
    }
}
