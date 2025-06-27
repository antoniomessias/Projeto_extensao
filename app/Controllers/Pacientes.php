<?php 
define('ROOT_PATH', dirname(__DIR__, 2));
define("BASE_URL", "/Projeto_extensao/");
require(ROOT_PATH . '/config/config.php');

class Pacientes
{
    private $con;

    public function __construct()
    {
        global $con;
        $this->con = $con;
    }

    public function index()
    {
        $page_title = 'Pacientes';
        $page_css = BASE_URL . 'assets/CSS/pacientes.css';

        // Listar pacientes e tutores
        $q = "SELECT P.id, P.nome AS pet, P.especie, P.peso, T.nome AS tutor, T.telefone
              FROM Pacientes P
              JOIN Tutores T ON P.tutor_id = T.id
              ORDER BY P.nome ASC";
        $pacientes = mysqli_query($this->con, $q);

        $editando = false;
        $dados = [];

        if (isset($_GET['editar'])) {
            $editando = true;
            $id = (int) $_GET['editar'];

            $q = "SELECT P.*, T.* FROM Pacientes P
                  JOIN Tutores T ON P.tutor_id = T.id
                  WHERE P.id = $id LIMIT 1";
            $res = mysqli_query($this->con, $q);
            $dados = mysqli_fetch_assoc($res);
        }

        require('app/Views/topo.php');
        require('app/Views/pacientes.php');
        require('app/Views/rodape.php');
    }

    public function salvar()
    {
        $p = $_POST;

        $nomeTutor = mysqli_real_escape_string($this->con, $p['nomeTutor']);
        $telefone = mysqli_real_escape_string($this->con, $p['telefoneTutor']);
        $email = mysqli_real_escape_string($this->con, $p['emailTutor']);
        $nomePet = mysqli_real_escape_string($this->con, $p['nomePet']);
        $especie = mysqli_real_escape_string($this->con, $p['especie']);
        $peso = (float) $p['peso'];

        if (isset($p['paciente_id']) && $p['paciente_id'] != '') {
            $paciente_id = (int) $p['paciente_id'];
            $tutor_id = (int) $p['tutor_id'];

            $q1 = "UPDATE Tutores SET nome='$nomeTutor', telefone='$telefone', email='$email'
                   WHERE id = $tutor_id";
            mysqli_query($this->con, $q1);

            $q2 = "UPDATE Pacientes SET nome='$nomePet', especie='$especie', peso=$peso
                   WHERE id = $paciente_id";
            mysqli_query($this->con, $q2);
        } else {
            $q1 = "INSERT INTO Tutores (nome, telefone, email, endereco)
                   VALUES ('$nomeTutor', '$telefone', '$email', '')";
            mysqli_query($this->con, $q1);
            $tutor_id = mysqli_insert_id($this->con);

            $q2 = "INSERT INTO Pacientes (nome, especie, raca, idade, peso, sexo, tutor_id)
                   VALUES ('$nomePet', '$especie', '', 0, $peso, 'M', $tutor_id)";
            mysqli_query($this->con, $q2);
        }

        header('Location: index.php?c=pacientes');
        exit;
    }

    public function remover()
    {
        $id = (int) $_GET['id'];

        $res = mysqli_query($this->con, "SELECT tutor_id FROM Pacientes WHERE id = $id");
        $row = mysqli_fetch_assoc($res);
        $tutor_id = $row['tutor_id'];

        mysqli_query($this->con, "DELETE FROM Pacientes WHERE id = $id");

        $check = mysqli_query($this->con, "SELECT COUNT(*) AS total FROM Pacientes WHERE tutor_id = $tutor_id");
        $count = mysqli_fetch_assoc($check);

        if ($count['total'] == 0) {
            mysqli_query($this->con, "DELETE FROM Tutores WHERE id = $tutor_id");
        }

        header('Location: index.php?c=pacientes');
        exit;
    }
}
