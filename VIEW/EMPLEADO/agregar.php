<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Empleado</title>
</head>
<body>
    <h1>Agregar Empleado</h1>
    <form action="admin.php?action=AgregarEmpleado" method="POST" onsubmit="return validarFormulario()">
        <label for="idcargo">Cargo:</label><br>
        <select id="idcargo" name="idcargo" required>
            <option value="1">Administrador</option>
            <option value="2">Operador</option>
        </select><br><br>
        
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" required><br><br>
        
        <label for="dni">DNI (solo números, máximo 8 caracteres):</label><br>
        <input type="text" id="dni" name="dni" maxlength="8" pattern="[0-9]+" title="Por favor, ingrese solo números" required><br><br>
        
        <input type="submit" value="Agregar Empleado">
    </form>

    <script>
        function validarFormulario() {
            var idcargo = document.getElementById('idcargo').value;
            var nombre = document.getElementById('nombre').value;
            var apellido = document.getElementById('apellido').value;
            var dni = document.getElementById('dni').value;

            
            if (idcargo.trim() === '' || nombre.trim() === '' || apellido.trim() === '' || dni.trim() === '') {
                alert('Por favor, complete todos los campos.');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
