<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/estilo-Reserva-index.css">

    <title>Listar Mantenimiento - Admin</title>
</head>
<body>
    <h1>Listar Mantenimiento</h1>
    <a href="admin.php?action=agregarMantenimiento">Agregar Nuevo Mantenimiento</a>
    <form action="admin.php" method="GET">
        <input type="hidden" name="action" value="buscarMantenimiento">
        <input type="text" name="termino" placeholder="Buscar...">
        <button type="submit">Buscar</button>
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Nro Maquinaria</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Costo</th>
                <th>Empleado</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $mantenimiento) { ?>
                <tr>
                    <td><?php echo $mantenimiento['idmantenimiento']; ?></td>
                    <td><?php echo $mantenimiento['idmaquinaria']; ?></td>
                    <td><?php echo $mantenimiento['fecha']; ?></td>
                    <td><?php echo $mantenimiento['descripcion']; ?></td>
                    <td><?php echo $mantenimiento['costopro']; ?></td>
                    <td><?php echo $mantenimiento['idempleado']; ?></td>
                    <td><?php echo $mantenimiento['tipo']; ?></td>
                    <td>
                        <a href="admin.php?action=editarMantenimiento&idmantenimiento=<?php echo $mantenimiento['idmantenimiento']; ?>">Editar</a>
                        <a href="admin.php?action=eliminarMantenimiento&idmantenimiento=<?php echo $mantenimiento['idmantenimiento']; ?>">Eliminar</a>
                    </td>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
