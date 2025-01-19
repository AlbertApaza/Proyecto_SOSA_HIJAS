<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Maquinaria</title>
</head>
<body>
    <h2>¿Estás seguro de que deseas eliminar esta maquinaria?</h2>
    <form action="admin.php?action=eliminarMaquinaria&idmaquinaria=<?php echo $_GET['idmaquinaria']; ?>" method="POST">
        <button type="submit" name="confirmar_eliminar">Sí, Eliminar</button>
        <a href="admin.php?action=MenuMaquinaria">Cancelar</a>
    </form>
</body>
</html>
