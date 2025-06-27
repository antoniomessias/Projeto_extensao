<?php
define('ROOT_PATH', dirname(__DIR__, 2));
define("BASE_URL", "/Projeto_extensao/");
require(ROOT_PATH . '/config/config.php');

class Usuarios
{
    private $con;

    public function __construct()
    {
        global $con;
        $this->con = $con;
    }

    public function index($erros = '')
    {
        $page_title = 'Cadastro de Usuários';
        $page_css = BASE_URL . 'assets/CSS/exames.css';

        $usuarios = mysqli_query($this->con, "SELECT * FROM Usuarios ORDER BY nome");

        $editando = false;
        $dados = [];

        if (isset($_GET['editar'])) {
            $editando = true;
            $id = (int) $_GET['editar'];
            $res = mysqli_query($this->con, "SELECT * FROM Usuarios WHERE id = $id");
            $dados = mysqli_fetch_assoc($res);
        }

        require('app/Views/topo.php');
        require('app/Views/usuarios.php');
        require('app/Views/rodape.php');
    }

    public function adicionar()
    {
        $p = $_POST;
        $erros = '';

        if (!empty($p['nome']) && !empty($p['email']) && !empty($p['tipo'])) {
            $nome = mysqli_real_escape_string($this->con, $p['nome']);
            $email = mysqli_real_escape_string($this->con, $p['email']);
            $perfil = mysqli_real_escape_string($this->con, $p['tipo']); // "tipo" no formulário, mas "perfil" no banco

            if (isset($p['usuario_id']) && $p['usuario_id'] != '') {
                // Editar usuário
                $id = (int) $p['usuario_id'];
                $sql = "UPDATE Usuarios SET nome='$nome', email='$email', perfil='$perfil'";
                if (!empty($p['senha'])) {
                    $senha = password_hash($p['senha'], PASSWORD_DEFAULT);
                    $sql .= ", senha='$senha'";
                }
                $sql .= " WHERE id=$id";
            } else {
                // Novo usuário
                if (empty($p['senha'])) {
                    $erros = "A senha é obrigatória para novo usuário.";
                    return $this->index($erros);
                }
                $senha = password_hash($p['senha'], PASSWORD_DEFAULT);
                $sql = "INSERT INTO Usuarios (nome, email, senha, perfil) VALUES ('$nome', '$email', '$senha', '$perfil')";
            }

            if (mysqli_query($this->con, $sql)) {
                header('Location: index.php?c=usuarios');
                exit;
            } else {
                $erros = "Erro ao salvar: " . mysqli_error($this->con);
            }
        } else {
            $erros = "Todos os campos são obrigatórios.";
        }

        $this->index($erros);
    }

    public function remover()
    {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            mysqli_query($this->con, "DELETE FROM Usuarios WHERE id = $id");
        }
        header('Location: index.php?c=usuarios');
        exit;
    }
}
