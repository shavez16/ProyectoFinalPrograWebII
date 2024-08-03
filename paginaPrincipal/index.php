<?php
// Conectar a la base de datos
require '../includes/config/database.php';
$db = conectarDB();

// Realizar la consulta a la base de datos
$query = "SELECT * FROM publicaciones ORDER BY creado DESC";
$resultado = mysqli_query($db, $query);

// Mensaje condicional
$result = $_GET['resultado'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="css/estiloIndex.css">
</head>
<body>
    <header>
        <h1>Página Principal</h1>
        <a href="../admin/blog/crear.php" class="boton-crear">Crear Publicación</a>
        <a href="" class="boton-cerrar-sesion">Cerrar Sesión</a>
    </header>

    <main>
        <?php if ($result): ?>
            <p class="mensaje exito">Publicación creada exitosamente</p>
        <?php endif; ?>

        <div class="publicaciones">
            <?php while ($publicacion = mysqli_fetch_assoc($resultado)): ?>
                <div class="publicacion">
                    <img src="../imagenes/<?php echo $publicacion['imagen']; ?>" alt="Imagen de la Publicación">
                    <p><?php echo $publicacion['descripcion']; ?></p>
                    <small><?php echo $publicacion['creado']; ?></small>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
</body>
</html>
