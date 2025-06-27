<?php
    // Verifica se o usuário é admin (via Firebase ou sessão PHP)
    session_start();
    if (!isset($_SESSION['user']) || !$_SESSION['user']['isAdmin']) {
        header("Location: ../index.php");
        exit();
    }
    ?>

    <?php include '../includes/topo.php'; ?>

    <div class="admin-content">
    <h2>Criar Novo Usuário</h2>
    <form id="formCriarUsuario">
        <input type="email" id="novoEmail" placeholder="E-mail" required>
        <input type="password" id="novaSenha" placeholder="Senha" required>
        <select id="nivelAcesso">
        <option value="user">Usuário Comum</option>
        <option value="admin">Administrador</option>
        </select>
        <button type="button" id="btnCriarUsuario">Criar Usuário</button>
    </form>
    <p id="statusCriacao"></p>
    </div>

    <script src="../assets/js/admin.js"></script>

<?php include '../includes/rodape.php'; ?>