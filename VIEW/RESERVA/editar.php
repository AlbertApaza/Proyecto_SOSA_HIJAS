<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
</head>
<body>
    <h1>Editar Reserva</h1>

    <?php if (isset($idcliente)) { ?>
    <form action="admin.php?action=editarReserva&idreserva=<?php echo $datos['idreserva']; ?>" method="POST">
        <input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
        <label for="idcliente">Cliente:</label>
        <select id="idcliente" name="idcliente" required>
            <option value="">Seleccione un cliente</option>
            <?php foreach ($clientes as $cliente) : ?>
                <?php $selected = ($datos['idcliente'] == $cliente['idcliente']) ? 'selected' : ''; ?>
                <option value="<?php echo $cliente['idcliente']; ?>" <?php echo $selected; ?>>
                    <?php echo "{$cliente['nombre']} {$cliente['apellido']}"; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="idmaquinaria">Maquinaria:</label>
        <select id="idmaquinaria" name="idmaquinaria" required>
            <option value="">Seleccione una maquinaria</option>
            <?php foreach ($maquinarias as $maquinaria) : ?>
                <?php $selected = ($datos['idmaquinaria'] == $maquinaria['idmaquinaria']) ? 'selected' : ''; ?>
                <option value="<?php echo $maquinaria['idmaquinaria']; ?>" <?php echo $selected; ?>>
                    <?php echo "{$maquinaria['nombre']} {$maquinaria['marca']} {$maquinaria['modelo']}"; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="idcotize">Cotización ID:</label>
        <input type="text" id="idcotize" name="idcotize" value="<?php echo $datos['idcotize']; ?>" required><br>

        <label for="idempleado">Empleado:</label>
        <select id="idempleado" name="idempleado" required>
            <option value="">Seleccione un empleado</option>
            <?php foreach ($empleados as $empleado) : ?>
                <?php $selected = ($datos['idempleado'] == $empleado['idempleado']) ? 'selected' : ''; ?>
                <option value="<?php echo $empleado['idempleado']; ?>" <?php echo $selected; ?>>
                    <?php echo "{$empleado['nombre']} {$empleado['apellido']}"; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="fechainicio">Fecha de Inicio:</label>
        <input type="datetime-local" id="fechainicio" name="fechainicio" value="<?php echo date('Y-m-d\TH:i', strtotime($datos['fechainicio'])); ?>" required><br>

        <label for="fechafin">Fecha de Fin:</label>
        <input type="datetime-local" id="fechafin" name="fechafin" value="<?php echo date('Y-m-d\TH:i', strtotime($datos['fechafin'])); ?>" required><br>

        <input type="hidden" id="fechareserva" name="fechareserva" value="<?php echo date('Y-m-d\TH:i'); ?>"><br>
        
        <button type="submit">Actualizar Reserva</button>
    </form>
    <?php } ?>
    
</body>
</html>
