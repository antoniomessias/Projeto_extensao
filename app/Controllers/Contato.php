<?php 
  define('ROOT_PATH', dirname(__DIR__, 2));
  define("BASE_URL", "/Projeto_extensao/");

  class Contato{

    public function index(){
      
      $page_title = 'Contato';
      $page_css = BASE_URL . 'assets/CSS/contato.css';
      require('app/Views/topo.php');
      require('app/Views/contato.php');
      require('app/Views/rodape.php');

    }

  }

?>