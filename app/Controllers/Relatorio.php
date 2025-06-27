<?php
define('ROOT_PATH', dirname(__DIR__, 2));
define("BASE_URL", "/Projeto_extensao/");
require(ROOT_PATH . '/config/config.php');

class Relatorio
{
    private $con;

    public function __construct()
    {
        global $con;
        $this->con = $con;
    }

    public function index()
    {
        $page_title = 'Relatório Clínico';
        $page_css = BASE_URL . 'assets/CSS/pacientes.css';

        // relatório do banco, buscar para a view
        // $relatorios = mysqli_query($this->con, "SELECT * FROM ...");

        require('app/Views/topo.php');
        require('app/Views/relatorio.php');
        require('app/Views/rodape.php');
    }
}
