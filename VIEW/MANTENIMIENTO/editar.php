<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mantenimiento</title>
</head>
<body>
    <h1>Editar Mantenimiento</h1>
    <form action="admin.php?action=editarMantenimiento&idmantenimiento=<?php echo $datos['idmantenimiento']; ?>" method="POST">
    <input type="hidden" name="idmantenimiento" value="<?php echo $datos['idmantenimiento']; ?>">
        
        <label for="idmaquinaria">Maquinaria:</label>
        <select id="idmaquinaria" name="idmaquinaria" required>
            <option value="">Seleccione una maquinaria</option>
            <?php
            foreach ($maquinarias as $maquinaria) {
                $selected = ($maquinaria['idmaquinaria'] == $datos['idmaquinaria']) ? 'selected' : '';
                echo "<option value=\"{$maquinaria['idmaquinaria']}\" $selected>{$maquinaria['nombre']} - {$maquinaria['numserie']}</option>";
            }
            ?>
        </select><br>
        
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo $datos['fecha']; ?>" required><br>
        
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo $datos['descripcion']; ?></textarea><br>
        
        <label for="costopro">Costo:</label>
        <input type="number" step="0.01" id="costopro" name="costopro" value="<?php echo $datos['costopro']; ?>" required><br>
        
        <label for="idempleado">Empleado:</label>
        <select id="idempleado" name="idempleado" required>
            <option value="">Seleccione un empleado</option>
            <?php
            foreach ($empleados as $empleado) {
                $selected = ($empleado['idempleado'] == $datos['idempleado']) ? 'selected' : '';
                echo "<option value=\"{$empleado['idempleado']}\" $selected>{$empleado['nombre']} {$empleado['apellido']}</option>";
            }
            ?>
        </select><br>
        
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="1" <?php echo ($datos['estado'] == 1) ? 'selected' : ''; ?>>Activo</option>
            <option value="0" <?php echo ($datos['estado'] == 0) ? 'selected' : ''; ?>>Inactivo</option>
        </select><br>
        
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="">Seleccione un tipo</option>
            <option value="preventivo" <?php echo ($datos['tipo'] == 'preventivo') ? 'selected' : ''; ?>>Preventivo</option>
            <option value="limpieza" <?php echo ($datos['tipo'] == 'limpieza') ? 'selected' : ''; ?>>Limpieza</option>
            <option value="revision" <?php echo ($datos['tipo'] == 'revision') ? 'selected' : ''; ?>>Revisión</option>
        </select><br>
        
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
