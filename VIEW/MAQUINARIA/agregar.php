<body>
    <h1>Agregar Nueva Maquinaria</h1>
    <form action="admin.php?action=agregarMaquinaria" method="POST" enctype="multipart/form-data">

        <label for="numserie">Número de Serie:</label>
        <input type="text" id="numserie" name="numserie" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required><br><br>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required><br><br>

        <label for="costoh">Costo por Hora:</label>
        <input type="number" step="0.01" id="costoh" name="costoh" required><br><br>

        <label for="imagenprincipal">Imagen Principal:</label>
        <input type="file" id="imagenprincipal" name="imagenprincipal" accept="image/*" required><br><br>

        <input type="submit" value="Agregar Maquinaria">
    </form>
</body>
