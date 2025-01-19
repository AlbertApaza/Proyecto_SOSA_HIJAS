<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Mantenimiento</title>
</head>
<body>
    <h1>Eliminar Mantenimiento</h1>
    <p>¿Estás seguro de que deseas eliminar este mantenimiento?</p>
    <form action="admin.php?action=eliminarMantenimiento&idmantenimiento=<?php echo $_GET['idmantenimiento']; ?>" method="POST">
        <button type="submit">Eliminar</button>
        <a href="admin.php?action=MenuMantenimiento">Cancelar</a>
    </form>
</body>
</html>
