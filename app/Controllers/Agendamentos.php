<?php
// app/Controllers/Agendamentos.php

define('ROOT_PATH', dirname(__DIR__, 2));
define("BASE_URL", "/Projeto_extensao/");
require(ROOT_PATH . '/config/config.php');

class Agendamentos
{
    private $con;

    public function __construct()
    {
        global $con;
        $this->con = $con;
    }

    public function index($erros = '')
    {
        $page_title = 'Agendamentos';
        $page_css = BASE_URL . 'assets/CSS/agendamento.css';

        $tutores = mysqli_query($this->con, "SELECT id, nome FROM Tutores ORDER BY nome");

        $pacientes = mysqli_query($this->con, "
            SELECT P.id, P.nome AS paciente_nome, T.nome AS tutor_nome
            FROM Pacientes P
            JOIN Tutores T ON P.tutor_id = T.id
            ORDER BY P.nome
        ");

        $consultas = mysqli_query($this->con, "
            SELECT C.*, P.nome AS paciente
            FROM Consultas C
            JOIN Pacientes P ON C.paciente_id = P.id
            WHERE C.status != 'Concluída'
            ORDER BY C.data DESC
        ");

        $editando = false;
        $dados = [];

        if (isset($_GET['editar'])) {
            $editando = true;
            $id = (int) $_GET['editar'];
            $q = "SELECT C.*, P.nome AS paciente 
                  FROM Consultas C
                  JOIN Pacientes P ON C.paciente_id = P.id
                  WHERE C.id = $id";
            $res = mysqli_query($this->con, $q);
            $dados = mysqli_fetch_assoc($res);
        }

        require('app/Views/topo.php');
        require('app/Views/agendamentos.php');
        require('app/Views/rodape.php');
    }

    public function adicionar()
    {
        $p = $_POST;
        $erros = '';

        if (
            isset($p['paciente'], $p['data'], $p['hora'], $p['veterinario']) &&
            !empty($p['paciente']) && !empty($p['data']) && !empty($p['hora']) && !empty($p['veterinario'])
        ) {
            $paciente_id = (int) $p['paciente'];
            $data_hora = $p['data'] . ' ' . $p['hora'];
            $motivo = mysqli_real_escape_string($this->con, $p['observacoes']);
            $observacoes = 'Veterinário: ' . mysqli_real_escape_string($this->con, $p['veterinario']);

            if (isset($p['consulta_id']) && $p['consulta_id'] != '') {
                $id = (int) $p['consulta_id'];
                $q = "UPDATE Consultas SET 
                      paciente_id=$paciente_id,
                      data='$data_hora',
                      motivo='$motivo',
                      observacoes='$observacoes'
                      WHERE id=$id";
            } else {
                $q = "INSERT INTO Consultas (paciente_id, data, status, motivo, observacoes)
                      VALUES ($paciente_id, '$data_hora', 'Aberta', '$motivo', '$observacoes')";
            }

            if (mysqli_query($this->con, $q)) {
                header('Location: index.php?c=agendamentos');
                exit;
            } else {
                $erros = "Erro ao salvar: " . mysqli_error($this->con);
            }
        } else {
            $erros = "Campos obrigatórios ausentes.";
        }

        $this->index($erros);
    }

    public function remover()
    {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            mysqli_query($this->con, "DELETE FROM Consultas WHERE id = $id");
        }
        header('Location: index.php?c=agendamentos');
        exit;
    }
}
