<?php
require '../../includes/config/database.php';

//Validamos que el id sea valido

$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('location: / admin');
}

//importar la conexion
$base = conectarDB();
$consulta = "SELECT * FROM publicaciones WHERE id = $id";
$resultado = mysqli_query($base,$consulta);
$publicacion = mysqli_fetch_assoc($resultado);

$descripcion = $publicacion['descripcion'];

echo "<pre>";
print_r($publicacion);
echo "</pre>";
exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar publicacion</title>
    <link rel="stylesheet" href="../../estilos/styleadmin.css">
</head>

<body>
    <div class="contenedor">
        <form action="" method="POST" enctype="multipart/form-data" class="formulario ">
            <fieldset>
                <legend>Actualizar publicacion</legend>
                <label for="Descripcion">Descripcion</label>
                <input type="text" id="Descripcion" name="Descripcion" placeholder="Escribe una descripcion" value="Hola">
                <label for="imagen">Imagen</label>
                <input type="file" accept="image/jpeg, image/png" name="imagen">
            </fieldset>
            <fieldset>
                <legend>Actualizar</legend>
                <input type="submit" value="Guardar" class="boton-verde">
            </fieldset>
        </form>
    </div>


</body>

</html>