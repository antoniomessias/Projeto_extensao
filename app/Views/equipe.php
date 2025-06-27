<div class="content">
  <h2>Equipe Cadastrada</h2>

  <?php if (mysqli_num_rows($usuarios) == 0): ?>
    <p>Nenhum usuário cadastrado.</p>
  <?php else: ?>
    <?php while ($u = mysqli_fetch_assoc($usuarios)): ?>
      <div class="paciente-card">
        <div class="texto">
          <h3>
            <?php
              // Ícone baseado no perfil
              $icon = '👤';
              if (isset($u['perfil'])) {
                  $perfil = strtolower($u['perfil']);
                  if ($perfil === 'administrador') {
                      $icon = '🛡️';
                  } elseif ($perfil === 'veterinario') {
                      $icon = '⚕️';
                  } elseif ($perfil === 'recepcionista') {
                      $icon = '📞';
                  }
              }
              echo $icon . ' ' . htmlspecialchars($u['nome']);
            ?>
          </h3>
          <p><strong>Email:</strong> <?= htmlspecialchars($u['email']) ?></p>
          <p><strong>Perfil:</strong> <?= htmlspecialchars($u['perfil']) ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>
</div>
