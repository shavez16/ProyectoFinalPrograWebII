<?php


//Validar que sea un Id valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT); //Validamos que el valor sea un Int 

if (!$id) {
    header('Location: /admin'); //si el valor del get no es un Int me dirige a admin.php
}

//Base de datos
require '../../includes/config/database.php';
$db = conectarDB();

//Obtener los datos de la publicacion
$consulta = "SELECT * FROM publicaciones WHERE id = $id";
$resultado = mysqli_query($db, $consulta);
$publicacion = mysqli_fetch_assoc($resultado);

//Este arreglo me sirve para almacenar errores y despues llamarlos
$errores = [];

//Declaracion de variables
$descripcion = $publicacion['descripcion'];
$imagenPublicacion = $publicacion['imagen'];

//Ejecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //  echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $descripcion = $_POST['descripcion'];


    $creado = date('Y/m/d');

    //Asignar FILE para las imagenes
    $imagen = $_FILES['imagen'];

    if (strlen($descripcion) < 20) {
        $errores[] = "La descripcion es obligatoria y debe tener al menos 20 caracteres ";
    }

    //Aqui valido la imagen

    if (!$imagen['name'] || $imagen['error']) {
        $errores[] = "La imagen es obligatoria";
    }

    //Validar el tama;o de la imagen (1mb maximo)
    $medida = 1000 * 1000;
    if ($imagen['size'] > $medida) {
        $errores[] = "La imagen es muy pesada";
    }

    // Revisar que el arreglo no este vacio
    if (empty($errores)) {

        //Subida de archivo
        $carpertaImagenes = '../../imagenes/';
        if (!is_dir($carpertaImagenes)) {
            mkdir($carpertaImagenes);
        }

        $nombreImagen = '';
        if ($imagen['name']) {

            //Eliminar la imagen anterior
            unlink($carpertaImagenes . $publicacion['imagen']);

            //Generar un nombre unico a la imagen y concatenamos la extencion .jpg
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpertaImagenes . $nombreImagen);
        }else{
            $nombreImagen = $publicacion['imagen'];
        }

        //Insertar en la base de datos
        $query = "UPDATE publicaciones SET descripcion='$descripcion', imagen='$nombreImagen' WHERE id=$id";

        // echo $query;

        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            //Redireccionar al usuario al formulario anterior
            header('Location: /admin?resultado=2');
        }
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar publicación</title>
    <link rel="stylesheet" href="../../estilos/styleadmin.css">
</head>

<body>


    <div class="contenedor">
        <h1>Actualizar</h1>
        <a href="/admin" class="boton-guardar">↩ Volver</a>

        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>

        <form method="POST" enctype="multipart/form-data" class="formulario ">
            <fieldset>
                <legend>Actualizar publicación</legend>
                <label for="descripcion">Descripcion</label>
                <input type="text" id="descripcion" name="descripcion" placeholder="Escribe una descripcion" value="<?php echo $descripcion ?>">
                <label for="imagen">Imagen</label>
                <input type="file" accept="image/jpeg, image/png" name="imagen">
            </fieldset>
            <fieldset>
                <legend>Actualizar</legend>
                <input type="submit" value="↻ Actualizar" class="boton-actualizar">
            </fieldset>
        </form>
    </div>


</body>

</html>