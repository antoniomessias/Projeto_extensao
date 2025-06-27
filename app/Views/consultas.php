<div class="main-content">
  <div class="content">
    <div class="right-panel">
      <header class="topbar">
        <h1>AGENDA</h1>
      </header>

      <section class="status-cards">
        <div class="card">Aberta<br><span><?= $contadores['Aberta'] ?></span></div>
        <div class="card">Atrasada<br><span><?= $contadores['Atrasada'] ?></span></div>
        <div class="card">Concluída<br><span><?= $contadores['Concluída'] ?></span></div>
        <div class="card">Cancelada<br><span><?= $contadores['Cancelada'] ?></span></div>
      </section>
    </div>

    <div class="calendar-container">
      <h2>Calendário - Junho 2025</h2>
      <div id="calendar">
        <div class="calendar-header">
          <button disabled>&lt;</button>
          <span>Junho 2025</span>
          <button disabled>&gt;</button>
        </div>

        <div class="calendar-grid">
          <div class="calendar-days">
            <div>Dom</div><div>Seg</div><div>Ter</div><div>Qua</div><div>Qui</div><div>Sex</div><div>Sáb</div>
          </div>
          <div class="calendar-dates">
            <?php
              $ano = 2025; $mes = 6;
              $primeiroDia = date('w', strtotime("$ano-$mes-01"));
              $totalDias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

              for ($i = 0; $i < $primeiroDia; $i++) {
                echo "<div class='empty-cell'></div>";
              }

              for ($dia = 1; $dia <= $totalDias; $dia++) {
                  $dataAtual = sprintf('%04d-%02d-%02d', $ano, $mes, $dia);
                  $temConsulta = isset($consultas[$dataAtual]);
                  $classe = '';

                  if ($temConsulta) {
                      $status = strtolower(str_replace('í', 'i', $consultas[$dataAtual][0]['status']));
                      $classe = "status-$status";
                  }

                  echo "<div class='day-cell $classe'>
                          <a href='index.php?c=consultas&data=$dataAtual' style='color:inherit;text-decoration:none;'>$dia</a>
                        </div>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="detalhesConsultas">
  <h3>Detalhes da Consulta</h3>
  <div id="consulta-detalhes">
    <?php
      if (isset($_GET['data']) && isset($consultas[$_GET['data']])) {
          foreach ($consultas[$_GET['data']] as $c) {
              echo "<div class='consulta'>
                      <p><strong>ID:</strong> {$c['id']}</p>
                      <p><strong>Status:</strong> {$c['status']}</p>
                      <p><strong>Paciente:</strong> {$c['paciente']}</p>
                      <p><strong>Data:</strong> " . date('d/m/Y H:i', strtotime($c['data'])) . "</p>
                      <p><strong>Motivo:</strong> {$c['motivo']}</p>
                      <p><strong>Observações:</strong> {$c['observacoes']}</p>
                    </div><hr>";
          }
      } else {
          echo "<p>Selecione uma data no calendário para ver os detalhes das consultas.</p>";
      }
    ?>
  </div>
</div>
