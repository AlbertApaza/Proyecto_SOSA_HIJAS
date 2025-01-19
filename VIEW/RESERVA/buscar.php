<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Reserva</title>
</head>
<body>
    <h1>Buscar Reserva</h1>
    <form action="admin.php" method="GET">
        <input type="hidden" name="action" value="buscarReserva">
        <input type="text" name="termino" placeholder="Buscar...">
        <button type="submit">Buscar</button>
    </form>

    <?php if (!empty($datos)) { ?>
        <h2>Resultados de la búsqueda</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Cliente</th>
                    <th>ID Maquinaria</th>
                    <th>ID Cotización</th>
                    <th>ID Empleado</th>
                    <th>Fecha Reserva</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $reserva) { ?>
                    <tr>
                        <td><?php echo $reserva['idreserva']; ?></td>
                        <td><?php echo $reserva['cliente_nombre'] . ' ' . $reserva['cliente_apellido']; ?></td>
                        <td><?php echo $reserva['maquinaria_nombre']; ?></td>
                        <td><?php echo $reserva['cotizacion_total']; ?></td>
                        <td><?php echo $reserva['empleado_nombre'] . ' ' . $reserva['empleado_apellido']; ?></td>
                        <td><?php echo $reserva['fechareserva']; ?></td>
                        <td><?php echo $reserva['fechainicio']; ?></td>
                        <td><?php echo $reserva['fechafin']; ?></td>
                        <td><?php echo ($reserva['estado'] == 1) ? 'Activo' : 'Inactivo'; ?></td>
                        <td>
                            <a href="admin.php?action=editarReserva&idreserva=<?php echo $reserva['idreserva']; ?>">Editar</a>
                            <a href="admin.php?action=eliminarReserva&idreserva=<?php echo $reserva['idreserva']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else if (isset($datos)) { ?>
        <p>No se encontraron resultados para el término de búsqueda.</p>
    <?php } ?>
</body>
</html>
