<div class="content">
  <!-- Formulário de cadastro ou edição -->
  <div class="form-section">
    <h2><?= $editando ? 'Editar Cliente' : 'Cadastrar Cliente' ?></h2>
    <form action="index.php?c=pacientes&m=salvar" method="POST">
      <input type="hidden" name="paciente_id" value="<?= $dados['id'] ?? '' ?>">
      <input type="hidden" name="tutor_id" value="<?= $dados['tutor_id'] ?? '' ?>">

      <div>
        <label for="nomeTutor">Nome do Tutor:</label>
        <input type="text" id="nomeTutor" name="nomeTutor" value="<?= $dados['nome'] ?? '' ?>" required>
      </div>

      <div>
        <label for="telefoneTutor">Telefone:</label>
        <input type="tel" id="telefoneTutor" name="telefoneTutor" value="<?= $dados['telefone'] ?? '' ?>" required>
      </div>

      <div>
        <label for="emailTutor">E-mail:</label>
        <input type="email" id="emailTutor" name="emailTutor" value="<?= $dados['email'] ?? '' ?>">
      </div>

      <div>
        <label for="nomePet">Nome do Pet:</label>
        <input type="text" id="nomePet" name="nomePet" value="<?= $dados['nome_pet'] ?? $dados['nome'] ?? '' ?>" required>
      </div>

      <div>
        <label for="especie">Espécie:</label>
        <select id="especie" name="especie" required>
          <option value="">Selecione</option>
          <option value="Cachorro" <?= (isset($dados['especie']) && $dados['especie'] == 'Cachorro') ? 'selected' : '' ?>>Cachorro</option>
          <option value="Gato" <?= (isset($dados['especie']) && $dados['especie'] == 'Gato') ? 'selected' : '' ?>>Gato</option>
          <option value="Outros" <?= (isset($dados['especie']) && $dados['especie'] == 'Outros') ? 'selected' : '' ?>>Outros</option>
        </select>
      </div>

      <div>
        <label for="peso">Peso (kg):</label>
        <input type="number" id="peso" name="peso" step="0.1" value="<?= $dados['peso'] ?? '' ?>" required>
      </div>

      <button type="submit"><?= $editando ? 'Atualizar' : 'Salvar' ?></button>
    </form>
  </div>

  <!-- Lista de pacientes -->
  <div class="result-section">
    <h2>Pacientes Cadastrados</h2>

    <?php while ($p = mysqli_fetch_assoc($pacientes)): ?>
      <div class="paciente-card">
        <div class="texto">
          <h3><?= $p['pet'] ?> (<?= $p['especie'] ?>)</h3>
          <p><strong>Peso:</strong> <?= $p['peso'] ?> kg</p>
          <p><strong>Tutor:</strong> <?= $p['tutor'] ?></p>
          <p><strong>Telefone:</strong> <?= $p['telefone'] ?></p>
          <p>
            <a href="index.php?c=pacientes&editar=<?= $p['id'] ?>">✏️ Editar</a> |
            <a href="index.php?c=pacientes&m=remover&id=<?= $p['id'] ?>" onclick="return confirm('Remover paciente?')">🗑️ Remover</a>
          </p>
        </div>
        <div class="foto-pet">🐾</div>
      </div>
    <?php endwhile; ?>
  </div>
</div>
