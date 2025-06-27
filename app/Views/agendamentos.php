<div class="main-content">
  <div class="content">
    <div class="form-container">
      <form id="form-agendamento" action="index.php?c=agendamentos&m=adicionar" method="POST" novalidate>
        <h2><?= $editando ? 'Editar Consulta' : 'Agendar Nova Consulta' ?></h2>

        <?php if (!empty($erros)): ?>
          <p style="color:red;"><strong><?= $erros ?></strong></p>
        <?php endif; ?>

        <input type="hidden" name="consulta_id" value="<?= $dados['id'] ?? '' ?>">

        <div class="form-group">
          <label for="paciente">Paciente:</label>
          <select id="paciente" name="paciente" required>
            <option value="">Selecione um paciente</option>
            <?php while ($p = mysqli_fetch_assoc($pacientes)): ?>
              <option value="<?= $p['id'] ?>" <?= (isset($dados['paciente_id']) && $dados['paciente_id'] == $p['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($p['paciente_nome'] . ' (' . $p['tutor_nome'] . ')') ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="data">Data:</label>
          <input type="date" id="data" name="data" value="<?= isset($dados['data']) ? substr($dados['data'], 0, 10) : '' ?>" required>
        </div>

        <div class="form-group">
          <label for="hora">Hora:</label>
          <input type="time" id="hora" name="hora" value="<?= isset($dados['data']) ? substr($dados['data'], 11, 5) : '' ?>" required>
        </div>

        <div class="form-group">
          <label for="veterinario">Veterinário:</label>
          <select id="veterinario" name="veterinario" required>
            <option value="">Selecione um veterinário</option>
            <option value="Dr. João" <?= (isset($dados['observacoes']) && strpos($dados['observacoes'], 'Dr. João') !== false) ? 'selected' : '' ?>>Dr. João</option>
            <option value="Dra. Maria" <?= (isset($dados['observacoes']) && strpos($dados['observacoes'], 'Dra. Maria') !== false) ? 'selected' : '' ?>>Dra. Maria</option>
            <option value="Dr. Carlos" <?= (isset($dados['observacoes']) && strpos($dados['observacoes'], 'Dr. Carlos') !== false) ? 'selected' : '' ?>>Dr. Carlos</option>
          </select>
        </div>

        <div class="form-group">
          <label for="observacoes">Observações:</label>
          <textarea id="observacoes" name="observacoes"><?= htmlspecialchars($dados['motivo'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn-submit"><?= $editando ? 'Atualizar' : 'Agendar' ?></button>
      </form>
    </div>

    <div class="result-section">
      <h2>Consultas Agendadas</h2>
      <?php while ($c = mysqli_fetch_assoc($consultas)): ?>
        <div class="paciente-card">
          <div class="texto">
            <h3><?= htmlspecialchars($c['paciente']) ?></h3>
            <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($c['data'])) ?></p>
            <p><strong>Motivo:</strong> <?= htmlspecialchars($c['motivo']) ?></p>
            <p><strong><?= htmlspecialchars($c['observacoes']) ?></strong></p>
            <p>
              <a href="index.php?c=agendamentos&editar=<?= $c['id'] ?>">✏️ Editar</a> |
              <a href="index.php?c=agendamentos&m=remover&id=<?= $c['id'] ?>" onclick="return confirm('Remover agendamento?')">🗑️ Remover</a>
            </p>
          </div>
          <div class="foto-pet">📅</div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
