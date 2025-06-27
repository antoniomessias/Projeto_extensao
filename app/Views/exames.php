<div class="main-content">
  <div class="content">
    <form action="index.php?c=exames&m=adicionar" method="POST">
      <h2><?= $editando ? 'Editar Exame' : 'Agendar Novo Exame' ?></h2>

      <?php if (!empty($erros)): ?>
        <p style="color:red;"><strong><?= $erros ?></strong></p>
      <?php endif; ?>

      <input type="hidden" name="exame_id" value="<?= $dados['id'] ?? '' ?>">

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
        <label for="tipo-exame">Tipo de Exame:</label>
        <input type="text" id="tipo-exame" name="tipo-exame" value="<?= htmlspecialchars($dados['tipo'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" value="<?= htmlspecialchars($dados['data_exame'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" required>
      </div>

      <div class="form-group">
        <label for="observacoes">Observações:</label>
        <textarea id="observacoes" name="observacoes"><?= isset($dados['observacoes']) ? explode(" - ", $dados['observacoes'], 2)[1] ?? '' : '' ?></textarea>
      </div>

      <button type="submit" class="btn-submit"><?= $editando ? 'Atualizar' : 'Agendar' ?></button>
    </form>

    <div class="exames-agendados">
      <h2>Exames Agendados</h2>
      <table>
        <thead>
          <tr>
            <th>Paciente</th>
            <th>Tipo</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Observações</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($e = mysqli_fetch_assoc($exames)): ?>
            <tr>
              <td><?= htmlspecialchars($e['paciente']) ?></td>
              <td><?= htmlspecialchars($e['tipo']) ?></td>
              <td><?= date('d/m/Y', strtotime($e['data_exame'])) ?></td>
              <td><?= htmlspecialchars(explode(' - ', $e['observacoes'])[0]) ?></td>
              <td><?= htmlspecialchars(explode(' - ', $e['observacoes'])[1] ?? '') ?></td>
              <td>
                <a href="index.php?c=exames&editar=<?= $e['id'] ?>">✏️Editar</a> |
                <a href="index.php?c=exames&m=remover&id=<?= $e['id'] ?>" onclick="return confirm('Remover exame?')">🗑️Remover</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
