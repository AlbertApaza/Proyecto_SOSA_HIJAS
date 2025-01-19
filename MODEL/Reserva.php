<?php
class Reserva {
    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    // Listar
    public function listarReserva() {
        $sql = "SELECT 
                    r.idreserva, 
                    r.fechareserva, 
                    r.fechainicio, 
                    r.fechafin, 
                    r.estado, 
                    c.nombre AS cliente_nombre, 
                    c.apellido AS cliente_apellido, 
                    m.nombre AS maquinaria_nombre, 
                    co.tiempo AS cotizacion_tiempo, 
                    co.total AS cotizacion_total, 
                    e.nombre AS empleado_nombre, 
                    e.apellido AS empleado_apellido
                FROM tbreserva r
                JOIN tbcliente c ON r.idcliente = c.idcliente
                JOIN tbmaquinaria m ON r.idmaquinaria = m.idmaquinaria
                JOIN tbcotizacion co ON r.idcotize = co.idcotizacion
                JOIN tbempleado e ON r.idempleado = e.idempleado
                WHERE r.estado = 1"; // Filtrar solo reservas activas (estado = 1)
        
        $result = $this->db->query($sql);
    
        $reservas = array();
        while ($row = $result->fetch_assoc()) {
            $reservas[] = $row;
        }
        return $reservas;
    }
    

    public function agregarReserva($idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado) {
        try {
            $sqlCheck = "SELECT COUNT(*) as count FROM tbreserva WHERE idmaquinaria = ? AND estado = 1 AND (
                            (fechainicio BETWEEN ? AND ?) OR 
                            (fechafin BETWEEN ? AND ?) OR
                            (? BETWEEN fechainicio AND fechafin) OR
                            (? BETWEEN fechainicio AND fechafin)
                        )";
            $stmtCheck = $this->db->prepare($sqlCheck);
            $stmtCheck->bind_param("issssss", $idmaquinaria, $fechainicio, $fechafin, $fechainicio, $fechafin, $fechainicio, $fechafin);
            $stmtCheck->execute();
            $result = $stmtCheck->get_result();
            $row = $result->fetch_assoc();
            $stmtCheck->close();
    
            if ($row['count'] > 0) {
                echo "Ya existe una reserva conflictiva para esta maquinaria en el rango de fechas proporcionado.";
                return false;
            }
    
            $sql = "INSERT INTO tbreserva (idcliente, idmaquinaria, idcotize, idempleado, fechareserva, fechainicio, fechafin, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtReserva = $this->db->prepare($sql);
            $stmtReserva->bind_param("iiiisssi", $idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado);
            $stmtReserva->execute();
    
            $idreserva = $stmtReserva->insert_id;
            $stmtReserva->close();
    
            $sqlContrato = "INSERT INTO tbcontrato (idreserva) VALUES (?)";
            $stmtContrato = $this->db->prepare($sqlContrato);
            $stmtContrato->bind_param("i", $idreserva);
            $stmtContrato->execute();
            $stmtContrato->close();
    
            $this->db->commit();
    
            return true;
        } catch (Exception $e) {
            echo "Error al agregar la reserva: " . $e->getMessage();
            return false;
        }
    }
    
    
    public function eliminarReserva($idreserva) {
        try {
            $sql = "UPDATE tbreserva SET estado = 0 WHERE idreserva = ?";
            $stmt = $this->db->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->db->error);
            }
            $stmt->bind_param("i", $idreserva);
            $stmt->execute();
            
            $resultado = $stmt->affected_rows > 0;
            $stmt->close();
            return $resultado;
        } catch (Exception $e) {
            echo "Error al eliminar la reserva: " . $e->getMessage();
            return false;
        }
    }
    
    public function editarReserva($idreserva, $idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado) {
        try {
            $sql = "UPDATE tbreserva SET idcliente = ?, idmaquinaria = ?, idcotize = ?, idempleado = ?, fechareserva = ?, fechainicio = ?, fechafin = ?, estado = ? WHERE idreserva = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("iiiisssii", $idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado, $idreserva);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            echo "Error al editar la reserva: " . $e->getMessage();
            return false;
        }
    }
    // Reserva.php

    public function obtenerCotizacionPorCliente($idcliente) {
        $sql = "SELECT idcotizacion FROM tbcotizacion WHERE idcliente = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idcliente);
        $stmt->execute();
        $result = $stmt->get_result();
        $cotizacion = $result->fetch_assoc();
        $stmt->close();
        return $cotizacion ? $cotizacion['idcotizacion'] : null;
    }

    public function buscarReserva($termino) {
        $sql = "SELECT 
                    r.idreserva, 
                    r.fechareserva, 
                    r.fechainicio, 
                    r.fechafin, 
                    r.estado, 
                    c.nombre AS cliente_nombre, 
                    c.apellido AS cliente_apellido, 
                    m.nombre AS maquinaria_nombre, 
                    co.tiempo AS cotizacion_tiempo, 
                    co.total AS cotizacion_total, 
                    e.nombre AS empleado_nombre, 
                    e.apellido AS empleado_apellido
                FROM tbreserva r
                JOIN tbcliente c ON r.idcliente = c.idcliente
                JOIN tbmaquinaria m ON r.idmaquinaria = m.idmaquinaria
                JOIN tbcotizacion co ON r.idcotize = co.idcotizacion
                JOIN tbempleado e ON r.idempleado = e.idempleado
                WHERE c.nombre LIKE ? OR c.apellido LIKE ?";
        $stmt = $this->db->prepare($sql);
        $termino = "%$termino%";
        $stmt->bind_param('ss', $termino, $termino);
        $stmt->execute();
        $result = $stmt->get_result();

        $reservas = array();
        while ($row = $result->fetch_assoc()) {
            $reservas[] = $row;
        }
        return $reservas;
    }

    public function obtenerReservaPorId($idreserva) {
        $sql = "SELECT * FROM tbreserva WHERE idreserva = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idreserva);
        $stmt->execute();
        $result = $stmt->get_result();
        $reserva = $result->fetch_assoc();
        $stmt->close();
        return $reserva;
    }

    public function obtenerClientes() {
        $clientes = array();
        $consulta = $this->db->query("SELECT * FROM tbcliente");
        while ($fila = $consulta->fetch_assoc()) {
            $clientes[] = $fila;
        }
        return $clientes;
    }

    public function obtenerMaquinarias() {
        $maquinarias = array();
        $consulta = $this->db->query("SELECT * FROM tbmaquinaria WHERE estado = 1");
        while ($fila = $consulta->fetch_assoc()) {
            $maquinarias[] = $fila;
        }
        return $maquinarias;
    }
    

    public function obtenerCotizaciones() {
        $cotizaciones = array();
        $consulta = $this->db->query("SELECT * FROM tbcotizacion");
        while ($fila = $consulta->fetch_assoc()) {
            $cotizaciones[] = $fila;
        }
        return $cotizaciones;
    }

    public function obtenerEmpleados() {
        $empleados = array();
        $consulta = $this->db->query("SELECT * FROM tbempleado");
        while ($fila = $consulta->fetch_assoc()) {
            $empleados[] = $fila;
        }
        return $empleados;
    }

}
?>
