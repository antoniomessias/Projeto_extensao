<?php
define('ROOT_PATH', dirname(__DIR__, 2));
define("BASE_URL", "/Projeto_extensao/");
require(ROOT_PATH . '/config/config.php');

class Equipe
{
    private $con;

    public function __construct()
    {
        global $con;
        $this->con = $con;
    }

    public function index()
    {
        $page_title = 'Equipe Cadastrada';
        $page_css = BASE_URL . 'assets/CSS/relatorio.css'; // usa o CSS do relatório

        // Verifica se a coluna 'perfil' existe (em vez de 'tipo')
        $res = mysqli_query($this->con, "SHOW COLUMNS FROM Usuarios LIKE 'perfil'");
        if (mysqli_num_rows($res) == 0) {
            die("Erro: A coluna 'perfil' não existe na tabela Usuarios. Verifique o banco de dados.");
        }

        // Corrige a query para ordenar por 'perfil'
        $query = "SELECT * FROM Usuarios ORDER BY perfil, nome";
        $usuarios = mysqli_query($this->con, $query);

        require('app/Views/topo.php');
        require('app/Views/equipe.php');
        require('app/Views/rodape.php');
    }
}
