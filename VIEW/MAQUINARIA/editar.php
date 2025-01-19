<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Maquinaria</title>
</head>
<body>
    <h2>Editar Maquinaria</h2>
    <form action="admin.php?action=editarMaquinaria&idmaquinaria=<?php echo $maquinaria['idmaquinaria']; ?>" method="POST" enctype="multipart/form-data">
        <label for="numserie">Número de Serie:</label>
        <input type="text" name="numserie" value="<?php echo htmlspecialchars($maquinaria['numserie']); ?>"><br><br>
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($maquinaria['nombre']); ?>"><br><br>
        
        <label for="marca">Marca:</label>
        <input type="text" name="marca" value="<?php echo htmlspecialchars($maquinaria['marca']); ?>"><br><br>
        
        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo" value="<?php echo htmlspecialchars($maquinaria['modelo']); ?>"><br><br>
        
        <label for="costoh">Costo por Hora:</label>
        <input type="text" name="costoh" value="<?php echo htmlspecialchars($maquinaria['costoh']); ?>"><br><br>
        
        <label for="imagenprincipal">Imagen Principal:</label>
        <input type="file" id="imagenprincipal" name="imagenprincipal" accept="image/*"><br><br>
        <input type="hidden" name="imagen_actual" value="<?php echo htmlspecialchars($maquinaria['imagenprincipal']); ?>">

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
