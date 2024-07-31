<?php
function conectarDB() : mysqli{
    $db = mysqli_connect('cmsprogramacion.mysql.database.azure.com', 'CMSPROGRAMACIONWEB', 'mdP3@x5@x0Dx', 'base_web2');

    if (!$db) {
        echo "Hubo un error al conectar la base de datos: " . mysqli_connect_error();
        exit;
    } 
    return $db;
}

