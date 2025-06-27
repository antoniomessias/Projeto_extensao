<?php
// app/Controllers/Exames.php

define('ROOT_PATH', dirname(__DIR__, 2));
require(ROOT_PATH . '/config/config.php');
define("BASE_URL", "/Projeto_extensao/"); // <-- Adicione esta linha

class Exames
{
    private $con;

    public function __construct()
    {
        global $con;
        $this->con = $con;
    }

    public function index($erros = '')
    {
        $page_title = 'Exames';
        $page_css = BASE_URL . 'assets/CSS/exames.css';

        $pacientes = mysqli_query($this->con, "
            SELECT P.id, P.nome AS paciente_nome, T.nome AS tutor_nome
            FROM Pacientes P
            JOIN Tutores T ON P.tutor_id = T.id
            ORDER BY P.nome
        ");

        $exames = mysqli_query($this->con, "
            SELECT E.*, P.nome AS paciente
            FROM Exames E
            JOIN Pacientes P ON E.paciente_id = P.id
            ORDER BY E.data_exame DESC
        ");

        $editando = false;
        $dados = [];

        if (isset($_GET['editar'])) {
            $editando = true;
            $id = (int) $_GET['editar'];
            $res = mysqli_query($this->con, "SELECT * FROM Exames WHERE id = $id");
            $dados = mysqli_fetch_assoc($res);
        }

        require('app/Views/topo.php');
        require('app/Views/exames.php');
        require('app/Views/rodape.php');
    }

    public function adicionar()
    {
        $p = $_POST;
        $erros = '';

        if (
            isset($p['paciente'], $p['tipo-exame'], $p['data'], $p['hora']) &&
            !empty($p['paciente']) && !empty($p['tipo-exame']) && !empty($p['data']) && !empty($p['hora'])
        ) {
            $paciente_id = (int) $p['paciente'];
            $tipo = mysqli_real_escape_string($this->con, $p['tipo-exame']);
            $data = mysqli_real_escape_string($this->con, $p['data']);
            $hora = mysqli_real_escape_string($this->con, $p['hora']);
            $obs = mysqli_real_escape_string($this->con, $p['observacoes']);
            $observacoes = "$hora - $obs";

            if (!empty($p['exame_id'])) {
                $id = (int) $p['exame_id'];
                $q = "UPDATE Exames SET 
                        paciente_id=$paciente_id,
                        tipo='$tipo',
                        data_exame='$data',
                        observacoes='$observacoes'
                      WHERE id=$id";
            } else {
                $q = "INSERT INTO Exames (paciente_id, tipo, data_exame, observacoes)
                      VALUES ($paciente_id, '$tipo', '$data', '$observacoes')";
            }

            if (mysqli_query($this->con, $q)) {
                header('Location: index.php?c=exames');
                exit;
            } else {
                $erros = "Erro ao salvar: " . mysqli_error($this->con);
            }
        } else {
            $erros = "Preencha todos os campos obrigatórios.";
        }

        $this->index($erros);
    }

    public function remover()
    {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            mysqli_query($this->con, "DELETE FROM Exames WHERE id = $id");
        }
        header('Location: index.php?c=exames');
        exit;
    }
}
