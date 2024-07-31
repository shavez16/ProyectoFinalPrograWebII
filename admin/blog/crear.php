<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear publicación</title>
    <link rel="stylesheet" href="../../estilos/styleadmin.css">
</head>
<body>
    <div class="contenedor">
    <form action="" method="POST" enctype="multipart/form-data" class="formulario ">
        <fieldset>
            <legend>Crear una nueva publicacion</legend>
            <label for="Descripcion">Descripcion</label>
            <input type="text" id="Descripcion" name="Descripcion" placeholder="Escribe una descripcion">
            <label for="imagen">Imagen</label>
            <input type="file" accept="image/jpeg, image/png" name="imagen">
        </fieldset>
        <fieldset>
            <legend>Guardar</legend>
        <input type="submit" value="Guardar" class="boton-verde">
        </fieldset>
    </form>
    </div>
    
    
</body>
</html>