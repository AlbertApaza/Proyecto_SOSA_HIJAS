<?php
class Contrato {
    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    public function listarContrato() {
        $contratos = array();
    
        $consulta = $this->db->query("SELECT c.idcontrato, r.idreserva, cl.nombre, cl.apellido, r.fechainicio, r.fechafin
                                      FROM tbcontrato c
                                      JOIN tbreserva r ON c.idreserva = r.idreserva
                                      JOIN tbcliente cl ON r.idcliente = cl.idcliente
                                      ORDER BY c.idcontrato DESC");
    
        if ($consulta && $consulta->num_rows > 0) {
            while ($fila = $consulta->fetch_assoc()) {
                $contratos[] = $fila;
            }
        } else {
            echo "No se encontraron contratos.";
        }
    
        return $contratos;
    }

    public function agregarContrato($idreserva, $idcotizacion) {
        try {
            $sql = "INSERT INTO tbcontrato (idreserva, idcotizacion) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ii", $idreserva, $idcotizacion);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            echo "Error al agregar el contrato: " . $e->getMessage();
            return false;
        }
    }

    public function editarContrato($idcontrato, $idreserva, $idcotizacion) {
        try {
            $sql = "UPDATE tbcontrato SET idreserva = ?, idcotizacion = ? WHERE idcontrato = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("iii", $idreserva, $idcotizacion, $idcontrato);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            echo "Error al editar el contrato: " . $e->getMessage();
            return false;
        }
    }

    public function eliminarContrato($idcontrato) {
        try {
            $sql = "DELETE FROM tbcontrato WHERE idcontrato = ?";
            $stmt = $this->db->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->db->error);
            }
            $stmt->bind_param("i", $idcontrato);
            $stmt->execute();
            
            $resultado = $stmt->affected_rows > 0;
            $stmt->close();
            return $resultado;
        } catch (Exception $e) {
            echo "Error al eliminar el contrato: " . $e->getMessage();
            return false;
        }
    }

    public function buscarContrato($termino) {
        $contratos = array();
        $termino = "%" . $termino . "%";
        $sql = "SELECT * FROM tbcontrato WHERE idreserva LIKE ? OR idcotizacion LIKE ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $termino, $termino);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($fila = $result->fetch_assoc()) {
            $contratos[] = $fila;
        }
        $stmt->close();
        return $contratos;
    }

    public function obtenerContratoPorId($idcontrato) {
        $sql = "SELECT c.*, r.*, cot.*, cl.*, m.*, l.*
                FROM tbcontrato c
                JOIN tbreserva r ON c.idreserva = r.idreserva
                JOIN tbcotizacion cot ON c.idcotizacion = cot.idcotizacion
                JOIN tbcliente cl ON r.idcliente = cl.idcliente
                JOIN tbmaquinaria m ON r.idmaquinaria = m.idmaquinaria
                JOIN tblugar l ON cot.idlugar = l.idlugar
                WHERE c.idcontrato = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $idcontrato);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
