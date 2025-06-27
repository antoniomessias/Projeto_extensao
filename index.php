<?php
    $controler = 'Login';  // padrão
    $metodo = 'index';     // padrão

    if (isset($_GET['c'])) {
        $controler = $_GET['c'];
        $metodo = isset($_GET['m']) ? $_GET['m'] : $metodo;
    }

    require('./app/Controllers/' . $controler . '.php');

    $classe = new $controler();

    // Verifica se o método existe na classe antes de chamar
    if (method_exists($classe, $metodo)) {
        $classe->$metodo();
    } else {
        echo "Erro: método '$metodo' não encontrado no controller '$controler'.";
    }
