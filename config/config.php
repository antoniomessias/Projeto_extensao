<?php

    $host = 'caboose.proxy.rlwy.net';
    $user = 'root';
    $pwd = 'kJqJYEeawnicWGTYuzVlEUPtNeFZJMxi';
    $db = 'clinicaVeterinaria' ; 
    $port = 24605;

    $con = mysqli_connect($host, $user, $pwd, $db, $port);

    if (!$con) {
        die("Erro ao conectar ao banco: " . mysqli_connect_error());
    }

?>

