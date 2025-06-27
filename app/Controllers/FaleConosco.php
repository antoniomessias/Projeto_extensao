<?php 
  define('ROOT_PATH', dirname(__DIR__, 2));
  define("BASE_URL", "/Projeto_extensao/");

  class FaleConosco{

    public function index(){
      
      $page_title = 'Fale Conosco';
      $page_css = BASE_URL . 'assets/CSS/faleConosco.css';
      require('app/Views/topo.php');
      require('app/Views/faleConosco.php');
      require('app/Views/rodape.php');

    }

  }

?>