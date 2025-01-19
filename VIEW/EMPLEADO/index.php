<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/estilo-Reserva-index.css">

    <title>Listar Empleados - Admin</title>
</head>
<body>
    <h1>Listar Empleados</h1>
    <a href="admin.php?action=AgregarEmpleado">Agregar Nuevo Empleado</a>
    <form action="admin.php" method="GET">
        <input type="hidden" name="action" value="buscarEmpleados">
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cargo</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $empleado) { ?>
                <tr>
                    <td><?php echo $empleado['idempleado']; ?></td>
                    <td><?php echo obtenerNombreCargo($empleado['idcargo']); ?></td>
                    <td><?php echo $empleado['nombre']; ?></td>
                    <td><?php echo $empleado['apellido']; ?></td>
                    <td><?php echo $empleado['dni']; ?></td>
                    <td>
                        <a href="admin.php?action=EditarEmpleado&idempleado=<?php echo $empleado['idempleado']; ?>">Editar</a>
                        <a href="admin.php?action=EliminarEmpleado&idempleado=<?php echo $empleado['idempleado']; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

<?php
function obtenerNombreCargo($idcargo) {
    if ($idcargo == 1) {
        return "Administrador";
    } else if ($idcargo == 2) {
        return "Operador";
    } else {
        return "Desconocido";
    }
}
?>
