<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda - Mantenimiento</title>
</head>
<body>
    <h1>Resultados de Búsqueda</h1>
    <a href="admin.php?action=MenuMantenimiento">Volver a la Lista de Mantenimientos</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Maquinaria</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Costo</th>
                <th>Empleado</th>
                <th>Estado</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($datos)) { ?>
                <?php foreach ($datos as $mantenimiento) { ?>
                    <tr>
                        <td><?php echo $mantenimiento['idmantenimiento']; ?></td>
                        <td><?php echo $mantenimiento['idmaquinaria']; ?></td>
                        <td><?php echo $mantenimiento['fecha']; ?></td>
                        <td><?php echo $mantenimiento['descripcion']; ?></td>
                        <td><?php echo $mantenimiento['costopro']; ?></td>
                        <td><?php echo $mantenimiento['idempleado']; ?></td>
                        <td><?php echo $mantenimiento['estado']; ?></td>
                        <td><?php echo $mantenimiento['tipo']; ?></td>
                        <td>
                            <a href="admin.php?action=editarMantenimiento&idmantenimiento=<?php echo $mantenimiento['idmantenimiento']; ?>">Editar</a>
                            <a href="admin.php?action=eliminarMantenimiento&idmantenimiento=<?php echo $mantenimiento['idmantenimiento']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="9">No se encontraron resultados.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
