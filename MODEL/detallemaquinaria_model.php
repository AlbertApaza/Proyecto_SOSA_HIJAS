<?php
require_once __DIR__ . '/../DB/db.php';

class clsDetalleMaquinariaModel {
    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    public function listarDetalleMaquinaria() {
        $query = "SELECT dm.*, m.nombre 
                  FROM tbdetallemaquinaria dm
                  JOIN tbmaquinaria m ON dm.idmaquinaria = m.idmaquinaria
                  WHERE dm.estado = 1 AND m.estado = 1";
        $result = $this->db->query($query);
        $detalles = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $detalles[] = $row;
            }
        }
        return $detalles;
    }

    public function obtenerDetallePorId($id) {
        $query = "SELECT * FROM tbdetallemaquinaria WHERE iddetalle = $id";
        $result = $this->db->query($query);
        return $result->fetch_assoc();
    }

    public function actualizarDetalle($data) {
        $id = $data['id'];
        $idmaquinaria = $data['idmaquinaria'];
        $descripcion = $data['descripcion'];
    
        $imagenes = ['imagen1', 'imagen2', 'imagen3'];
        $updates = [];
    
        foreach ($imagenes as $imagen) {
            if (isset($_FILES[$imagen]) && $_FILES[$imagen]['error'] == UPLOAD_ERR_OK) {
                $nombreImagen = $_FILES[$imagen]['name'];
                $tmpNombre = $_FILES[$imagen]['tmp_name'];
                $destino = __DIR__ . "/../IMAGENES/" . $nombreImagen;
                if (move_uploaded_file($tmpNombre, $destino)) {
                    $updates[] = "$imagen = '$nombreImagen'";
                } else {
                    echo "Error al subir la imagen $imagen<br>";
                }
            }
        }
    
        // Manejo del modelo 3D (.glb)
        if (!empty($_FILES['modelo3d']) && $_FILES['modelo3d']['error'] == UPLOAD_ERR_OK) {
            $nombreModelo = $_FILES['modelo3d']['name'];
            $tmpNombre = $_FILES['modelo3d']['tmp_name'];
            $destino = __DIR__ . "/../IMAGENES/MODELOS3D/" . $nombreModelo;
            if (move_uploaded_file($tmpNombre, $destino)) {
                $updates[] = "modelo3d = '$nombreModelo'";
            } else {
                echo "Error al subir el modelo 3D<br>";
            }
        }
    
        // Actualizar otros campos en la base de datos
        $updates[] = "idmaquinaria = '$idmaquinaria'";
        $updates[] = "descripcion = '$descripcion'";
    
        // Construir la consulta de actualización
        $updateQuery = "UPDATE tbdetallemaquinaria SET " . implode(", ", $updates) . " WHERE iddetalle = $id";
    
        // Ejecutar la consulta
        if ($this->db->query($updateQuery) === TRUE) {
            echo "Registro actualizado correctamente<br>";
        } else {
            echo "Error actualizando el registro: " . $this->db->error . "<br>";
        }
    }
    
}
?>