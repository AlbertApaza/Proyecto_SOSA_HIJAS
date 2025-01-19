<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reserva</title>
</head>
<body>
    <h1>Agregar Reserva</h1>
    
    <form action="admin.php?action=mostrarFormularioAgregar" method="POST">
        <label for="idcliente">Cliente:</label>
        <select id="idcliente" name="idcliente" onchange="this.form.submit()" required>
            <option value="">Seleccione un cliente</option>
            <?php
            foreach ($clientes as $cliente) {
                $selected = (isset($idcliente) && $idcliente == $cliente['idcliente']) ? 'selected' : '';
                echo "<option value=\"{$cliente['idcliente']}\" $selected>{$cliente['nombre']} {$cliente['apellido']}</option>";
            }
            ?>
        </select><br>
    </form>
    
    <?php if (isset($idcliente)) { ?>
    <form action="admin.php?action=agregarReserva" method="POST">
        <input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">

        <label for="idmaquinaria">Maquinaria:</label>
        <select id="idmaquinaria" name="idmaquinaria" required>
            <option value="">Seleccione una maquinaria</option>
            <?php
            foreach ($maquinarias as $maquinaria) {
                echo "<option value=\"{$maquinaria['idmaquinaria']}\">{$maquinaria['nombre']} {$maquinaria['marca']} {$maquinaria['modelo']}</option>";
            }
            ?>
        </select><br>

        <label for="idcotize">Cotización ID:</label>
        <input type="text" id="idcotize" name="idcotize" value="<?php echo isset($idcotize) ? $idcotize : ''; ?>" required><br>

        <label for="idempleado">Empleado:</label>
        <select id="idempleado" name="idempleado" required>
            <option value="">Seleccione un empleado</option>
            <?php
            foreach ($empleados as $empleado) {
                echo "<option value=\"{$empleado['idempleado']}\">{$empleado['nombre']} {$empleado['apellido']}</option>";
            }
            ?>
        </select><br>

        <label for="fechainicio">Fecha de Inicio:</label>
        <input type="datetime-local" id="fechainicio" name="fechainicio" value="<?php echo isset($fechainicio) ? $fechainicio : ''; ?>" required><br>

        <label for="fechafin">Fecha de Fin:</label>
        <input type="datetime-local" id="fechafin" name="fechafin" value="<?php echo isset($fechafin) ? $fechafin : ''; ?>" required><br>

        <input type="hidden" id="fechareserva" name="fechareserva" value="<?php echo date('Y-m-d\TH:i'); ?>"><br>
        
        <button type="submit">Agregar Reserva</button>
    </form>
    <?php } ?>
    
</body>
</html>
