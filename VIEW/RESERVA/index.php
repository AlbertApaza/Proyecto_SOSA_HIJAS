<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Reservas</title>
    <link rel="stylesheet" href="CSS/estilo-Reserva-index.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Listado de Reservas</h2>
        <form action="admin.php?action=buscarReserva" method="POST" class="form-inline mb-3">
            <div class="form-group mr-2">
                <label for="termino" class="mr-2">Buscar:</label>
                <input type="text" name="termino" id="termino" class="form-control">
            </div>
            <button type="submit" class="btn btn-buscar">Buscar</button>
        </form>

        <a href="admin.php?action=agregarReserva" class="btn btn-agregar mb-3">Agregar Reserva</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Reserva</th>
                    <th>Cliente</th>
                    <th>Maquinaria</th>
                    <th>Cotización</th>
                    <th>Empleado</th>
                    <th>Fecha Reserva</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva): ?>
                <tr>
                    <td><?php echo $reserva['idreserva']; ?></td>
                    <td><?php echo $reserva['cliente_nombre'] . ' ' . $reserva['cliente_apellido']; ?></td>
                    <td><?php echo $reserva['maquinaria_nombre']; ?></td>
                    <td><?php echo ' horas:' . $reserva['cotizacion_tiempo']. '(s/' . $reserva['cotizacion_total']. ')';; ?></td>
                    <td><?php echo $reserva['empleado_nombre'] . ' ' . $reserva['empleado_apellido']; ?></td>
                    <td><?php echo $reserva['fechareserva']; ?></td>
                    <td><?php echo $reserva['fechainicio']; ?></td>
                    <td><?php echo $reserva['fechafin']; ?></td>
                    <td>
                        <a href="admin.php?action=editarReserva&idreserva=<?php echo $reserva['idreserva']; ?>" class="btn-edit"><i class="fa fa-pencil-alt"></i> Editar</a>
                        <a href="admin.php?action=eliminarReserva&idreserva=<?php echo $reserva['idreserva']; ?>" class="btn-delete" onclick="return confirm('¿Está seguro de eliminar esta reserva?')"><i class="fa fa-times"></i> Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
