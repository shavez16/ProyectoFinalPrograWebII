<?php
function conectarDB() : mysqli{
    $db = mysqli_connect('localhost', 'root', '', 'aqui la base');

    if (!$db) {
        echo "Hubo un error al conectar la base de datos: " . mysqli_connect_error();
        exit;
    } 
    return $db;
}
