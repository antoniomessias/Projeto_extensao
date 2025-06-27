<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/Projeto_extensao/assets/css/estiloBase.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <?php if (isset($page_css)) : ?>
    <link rel="stylesheet" href="<?= $page_css ?>">
  <?php endif; ?>
  <title><?= $page_title ?></title>
</head>
<body>
  <div class="sidebar" id="sidebar">
    <button class="toggle-btn" onclick="toggleSidebar()">
      <i class="bi bi-list"></i>
    </button>
    <ul>
      <li><a href="/Projeto_extensao/index.php?c=Home&m=index"><i class="bi bi-house-door"></i><span>Início</span></a></li>
      <li><a href="/Projeto_extensao/index.php?c=Consultas&m=index"><i class="bi bi-clipboard"></i><span>Consultas</span></a></li>
      <li><a href="/Projeto_extensao/index.php?c=Agendamentos&m=index"><i class="bi bi-calendar"></i><span>Agendamentos</span></a></li>
      <li><a href="/Projeto_extensao/index.php?c=Exames&m=index"><i class="bi bi-file-earmark-medical"></i><span>Exames</span></a></li>
      <li><a href="/Projeto_extensao/index.php?c=Pacientes&m=index"><i class="bi bi-person"></i><span>Pacientes</span></a></li>
      <li><a href="/Projeto_extensao/index.php?c=Equipe&m=index"><i class="bi bi-people"></i><span>Equipe</span></a></li>
      <li><a href="/Projeto_extensao/index.php?c=Relatorio&m=index"><i class="bi bi-bar-chart"></i><span>Relatórios</span></a></li>
      <li><a href="/Projeto_extensao/index.php?c=Usuarios&m=index"><i class="bi bi-gear"></i><span>Cadastro Usuario</span></a></li>
      <li><a href="/Projeto_extensao/index.php?c=Sobre&m=index"><i class="bi bi-info-circle"></i><span>Sobre</span></a></li>
      <li><a href="/Projeto_extensao/index.php?c=Contato&m=index"><i class="bi bi-envelope"></i><span>Contato</span></a></li>
      <li><a href="/Projeto_extensao/index.php?c=FaleConosco&m=index"><i class="bi bi-chat"></i><span>Fale Conosco</span></a></li>
    </ul>
  </div>

  <div class="main-content">
    <div class="header">
      <div class="search-bar">
        <h1><?= isset($page_title) ? $page_title : 'Bem-vindo à Agro Suaçuna' ?></h1>
        <input type="text" id="search-button" placeholder="Buscar..." />
        <button><i class="bi bi-search"></i></button>
      </div>
      <div class="theme-switcher">
        <button class="theme-button" onclick="alternarMenu()"><i class="bi bi-moon-stars-fill"></i></button>
        <div class="dropdown" id="dropdown-tema">
          <div class="dropdown-item" onclick="definirTema('light')"><i class="bi bi-sun-fill"></i></div>
          <div class="dropdown-item" onclick="definirTema('dark')"><i class="bi bi-moon-stars-fill"></i></div>
        </div>
      </div>
    </div>
    <main>

    