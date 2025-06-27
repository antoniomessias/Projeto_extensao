<?php
session_start();
define('ROOT_PATH', dirname(__DIR__, 2));
define("BASE_URL", "/Projeto_extensao/");
require(ROOT_PATH . '/config/config.php');

class Login
{
    private $con;

    public function __construct()
    {
        global $con;
        $this->con = $con;
    }

    public function index($erro = '')
    {
        $page_title = 'Login';
        $page_css = BASE_URL . 'assets/CSS/login.css';

        require('app/Views/login.php');

    }

    public function autenticar()
    {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        if (empty($email) || empty($senha)) {
            return $this->index("Informe e-mail e senha.");
        }

        $email = mysqli_real_escape_string($this->con, $email);
        $res = mysqli_query($this->con, "SELECT * FROM Usuarios WHERE email = '$email' LIMIT 1");

        if ($res && mysqli_num_rows($res) == 1) {
            $usuario = mysqli_fetch_assoc($res);

            if (password_verify($senha, $usuario['senha'])) {
                // Login válido: criar sessão
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_perfil'] = $usuario['perfil'];

                // Redirecionar baseado no tipo
                if ($usuario['perfil'] === 'administrador') {
                    header("Location: index.php?c=usuarios");
                } elseif ($usuario['perfil'] === 'veterinario') {
                    header("Location: index.php?c=consultas");
                } else {
                    header("Location: index.php?c=home");
                }
                exit;
            }
        }

        // Se chegou aqui, login falhou
        $this->index("E-mail ou senha inválidos.");
    }

    public function sair()
    {
        session_destroy();
        header("Location: index.php?c=login");
        exit;
    }
}
