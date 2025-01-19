<?php
require_once __DIR__ . '/../DB/db.php';

class Lugar {
    private $db;

    public function __construct(){
        $this->db = Conectar::conexion();
    }

    public function obtenerTodosLugares() {
        try {
            $lugares = array();

            $sql = "SELECT idlugar, ciudad FROM tblugar";
            $resultado = $this->db->query($sql);

            if ($resultado && $resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    $lugares[] = $fila;
                }
                $resultado->close();
            }

            return $lugares;
        } catch (Exception $e) {
            echo "Error al obtener los lugares: " . $e->getMessage();
            return false;
        }
    }
}
?>
