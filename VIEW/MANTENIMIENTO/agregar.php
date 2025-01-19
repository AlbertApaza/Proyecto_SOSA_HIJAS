<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Mantenimiento</title>
</head>
<body>
    <h1>Agregar Mantenimiento</h1>
    <form action="admin.php?action=agregarMantenimiento" method="POST">
        <label for="idmaquinaria">Maquinaria:</label>
        <select id="idmaquinaria" name="idmaquinaria" required>
            <option value="">Seleccione una maquinaria</option>
            <?php
            foreach ($maquinarias as $maquinaria) {
                echo "<option value=\"{$maquinaria['idmaquinaria']}\">{$maquinaria['nombre']} - {$maquinaria['numserie']}</option>";
            }
            ?>
        </select><br>
        
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required><br>
        
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea><br>
        
        <label for="costopro">Costo:</label>
        <input type="number" step="0.01" id="costopro" name="costopro" required><br>
        
        <label for="idempleado">Empleado:</label>
        <select id="idempleado" name="idempleado" required>
            <option value="">Seleccione un empleado</option>
            <?php
            foreach ($empleados as $empleado) {
                echo "<option value=\"{$empleado['idempleado']}\">{$empleado['nombre']} {$empleado['apellido']}</option>";
            }
            ?>
        </select><br>
        
        
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="">Seleccione un tipo</option>
            <option value="preventivo">Preventivo</option>
            <option value="limpieza">Limpieza</option>
            <option value="revision">Revisión</option>
        </select><br>
        
        <button type="submit">Agregar Mantenimiento</button>
    </form>
</body>
</html>
