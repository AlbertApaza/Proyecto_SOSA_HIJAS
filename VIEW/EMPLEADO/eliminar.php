<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Empleado</title>
</head>
<body>
    <h1>Eliminar Empleado</h1>
    <p>¿Estás seguro que deseas eliminar este empleado?</p>

    <form action="admin.php?action=ConfirmarEliminarEmpleado" method="POST">
        <input type="hidden" name="idempleado" value="<?php echo $empleado['idempleado']; ?>">
        <p><strong>ID Empleado:</strong> <?php echo $empleado['idempleado']; ?></p>
        <p><strong>Nombre:</strong> <?php echo $empleado['nombre'] . ' ' . $empleado['apellido']; ?></p>

        <input type="submit" value="Eliminar">
        <a href="admin.php?action=listarEmpleado">Cancelar</a>
    </form>
</body>
</html>
