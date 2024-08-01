<?php
require '../includes/config/database.php';

//importar la conexion
$db = conectarDB();

//realizamos la consulta a la base
$query = " SELECT * FROM publicaciones";

$resultado = mysqli_query($db, $query);

//Muestra mensaje condicional
$result = $_GET['resultado'] ?? null; //busca el get si no existe le agrega un null

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {

        //Eliminar la imagen de la propiedad
        $consulta = "SELECT imagen FROM publicaciones WHERE id = $id";
        $resultado = mysqli_query($db, $consulta);
        $publicacion = mysqli_fetch_assoc($resultado);
        unlink('../imagenes/' . $publicacion['imagen']);

        //Eliminar la propiedad
        $query = "DELETE FROM publicaciones WHERE id = $id";
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            header('Location: /admin?resultado=3');
        }
    }
}

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
    <?php if (intval($result) === 1) : ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif (intval($result) === 2) : ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
    <?php elseif (intval($result) === 3) : ?>
        <p class="alerta exito">Registro Eliminado Correctamente</p>
    <?php endif; ?>
    <a class="boton-verde" href="../admin/blog/crear.php">Nueva publicacion</a>
        <table class="tabla1">
            <thead>
                <tr class="encabezado">
                    <th>Id</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Creado</th>
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
                        <td><?php echo $publicacion["creado"] ?></td>
                        <td> 
                            <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $publicacion['id']; ?>">
                            <button class="boton-rojo" type="submit" value="Eliminar">Eliminar</button>
                            </form> 
                            <a class="boton-anaranjado" href="../admin/blog/actualizar.php?id=<?php echo $publicacion["id"]; ?>">Actualizar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
        </table>
    </div>

</body>

</html>