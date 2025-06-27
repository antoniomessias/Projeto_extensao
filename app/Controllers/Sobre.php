<?php 
  define('ROOT_PATH', dirname(__DIR__, 2));
  define("BASE_URL", "/Projeto_extensao/");

  class Sobre{

    public function index(){
      
      $page_title = 'Sobre';
      $page_css = BASE_URL . 'assets/CSS/sobre.css';
      require('app/Views/topo.php');
      require('app/Views/sobre.php');
      require('app/Views/rodape.php');

    }

  }

?>