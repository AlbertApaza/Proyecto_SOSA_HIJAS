<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
</head>
<body>
    <h1>Editar Empleado</h1>
    <form action="admin.php?action=EditarEmpleado" method="POST">
        <input type="hidden" name="idempleado" value="<?php echo $empleado['idempleado']; ?>">
        
        <label for="idcargo">Cargo:</label><br>
        <select id="idcargo" name="idcargo" required>
            <option value="1" <?php if ($empleado['idcargo'] == 1) echo 'selected'; ?>>Administrador</option>
            <option value="2" <?php if ($empleado['idcargo'] == 2) echo 'selected'; ?>>Operador</option>
        </select><br><br>
        
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $empleado['nombre']; ?>" required><br><br>
        
        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" value="<?php echo $empleado['apellido']; ?>" required><br><br>
        
        <label for="dni">DNI (solo números, máximo 8 caracteres):</label><br>
        <input type="text" id="dni" name="dni" value="<?php echo $empleado['dni']; ?>" maxlength="8" pattern="[0-9]+" title="Por favor, ingrese solo números" required><br><br>
        
        <input type="submit" value="Actualizar Empleado">
    </form>
</body>
</html>
