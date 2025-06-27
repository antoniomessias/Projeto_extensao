<?php
define('ROOT_PATH', dirname(__DIR__, 2));
define("BASE_URL", "/Projeto_extensao/");
require(ROOT_PATH . '/config/config.php');

class Consultas {
    private $con;

    public function __construct() {
        global $con;
        $this->con = $con;
    }

    public function index() {
        $page_title = 'Consultas';
        $page_css = BASE_URL . 'assets/CSS/consulta.css';

        $ano = 2025;
        $mes = 6;

        $inicio = "$ano-$mes-01";
        $fim = "$ano-$mes-31";

        $res = mysqli_query($this->con, "
            SELECT C.id, C.data, C.status, C.motivo, C.observacoes, P.nome AS paciente
            FROM Consultas C
            JOIN Pacientes P ON C.paciente_id = P.id
            WHERE DATE(C.data) BETWEEN '$inicio' AND '$fim'
        ");

        $consultas = [];
        $contadores = ['Aberta' => 0, 'Atrasada' => 0, 'Cancelada' => 0, 'Concluída' => 0];

        while ($row = mysqli_fetch_assoc($res)) {
            $data = substr($row['data'], 0, 10);
            $consultas[$data][] = $row;
            if (isset($contadores[$row['status']])) {
                $contadores[$row['status']]++;
            }
        }

        require('app/Views/topo.php');
        require('app/Views/consultas.php');
        require('app/Views/rodape.php');
    }
}
