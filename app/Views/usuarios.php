<div class="main-content">
  <div class="content">
    <form action="index.php?c=usuarios&m=adicionar" method="POST">
      <h2><?= $editando ? 'Editar Usuário' : 'Cadastrar Novo Usuário' ?></h2>

      <?php if (!empty($erros)): ?>
        <p style="color:red;"><strong><?= $erros ?></strong></p>
      <?php endif; ?>

      <input type="hidden" name="usuario_id" value="<?= $dados['id'] ?? '' ?>">

      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($dados['nome'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($dados['email'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" <?= $editando ? '' : 'required' ?>>
      </div>

      <div class="form-group">
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
          <option value="">Selecione um tipo</option>
          <option value="administrador" <?= (isset($dados['perfil']) && $dados['perfil'] === 'administrador') ? 'selected' : '' ?>>Administrador</option>
          <option value="veterinario" <?= (isset($dados['perfil']) && $dados['perfil'] === 'veterinario') ? 'selected' : '' ?>>Veterinário</option>
          <option value="recepcionista" <?= (isset($dados['perfil']) && $dados['perfil'] === 'recepcionista') ? 'selected' : '' ?>>Recepcionista</option>
        </select>
      </div>

      <button type="submit" class="btn-submit"><?= $editando ? 'Atualizar' : 'Cadastrar' ?></button>
    </form>

    <div class="exames-agendados">
      <h2>Usuários Cadastrados</h2>
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Tipo</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($u = mysqli_fetch_assoc($usuarios)): ?>
            <tr>
              <td><?= htmlspecialchars($u['nome']) ?></td>
              <td><?= htmlspecialchars($u['email']) ?></td>
              <td><?= htmlspecialchars($u['perfil']) ?></td>
              <td>
                <a href="index.php?c=usuarios&editar=<?= $u['id'] ?>">✏️Editar</a> |
                <a href="index.php?c=usuarios&m=remover&id=<?= $u['id'] ?>" onclick="return confirm('Remover usuário?')">🗑️Remover</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
