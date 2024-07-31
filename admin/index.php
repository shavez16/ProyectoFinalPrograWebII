<?php
require '../includes/config/database.php';

//importar la conexion
$base = conectarDB();

//realizamos la consulta a la base
$query = " SELECT * FROM publicaciones";

$resultado = mysqli_query($base, $query);


// echo "<pre>";
// var_dump($resultado);
// echo "</pre>";
// exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../estilos/styleadmin.css">
</head>

<body>
    <h1>Administrar tus publicaciones</h1>
    
    <div class="contenedor">
    <a class="boton-verde" href="../admin/blog/crear.php">Nueva publicacion</a>
        <table class="tabla1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <?php while ($publicacion = mysqli_fetch_assoc($resultado)) : ?>
                <tbody>
                    <tr>
                        <td><?php echo $publicacion["id"] ?></td>
                        <td><?php echo $publicacion["descripcion"] ?></td>
                        <td>
                            <img src="../imagenes/<?php echo $publicacion["imagen"] ?>" alt="imagen1">
                        </td>
                        <td>
                            <a class="boton-anaranjado" href="../admin/blog/actualizar.php?id=<?php echo $publicacion["id"]; ?>">Actualizar</a>
                            <button class="boton-rojo" type="submit" value="Eliminar">Eliminar</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
        </table>
    </div>

</body>

</html>