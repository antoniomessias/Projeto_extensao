<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/login.css">

<div class="container">
  <h1>AgroSuaçuna 🐾<br>Login</h1>

  <?php if (!empty($erro)): ?>
    <div class="error"><strong><?= $erro ?></strong></div>
  <?php endif; ?>

  <form action="index.php?c=login&m=autenticar" method="POST">
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
  </form>
</div>
