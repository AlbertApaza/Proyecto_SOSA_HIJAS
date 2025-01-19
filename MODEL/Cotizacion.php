<?php
require_once __DIR__ . '/../DB/db.php';

class Cotizacion {
     
    public function actualizarCotizacion($idcotizacion, $idcliente, $idmaquinaria, $idlugar, $total, $tiempo) {
        try {
            $conexion = Conectar::conexion();
            
            $conexion->begin_transaction();
            
            $sql = "UPDATE tbcotizacion SET idcliente = ?, idmaquinaria = ?, idlugar = ?, total = ?, tiempo = ? WHERE idcotizacion = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("iiidii", $idcliente, $idmaquinaria, $idlugar, $total, $tiempo, $idcotizacion);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                $sqlCheck = "SELECT COUNT(*) FROM notifications WHERE user_id = ?";
                $stmtCheck = $conexion->prepare($sqlCheck);
                $stmtCheck->bind_param("i", $idcliente);
                $stmtCheck->execute();
                $stmtCheck->bind_result($count);
                $stmtCheck->fetch();
                $stmtCheck->close();
    
                if ($count == 0) {
                    $mensaje = "Nueva Cotización registrada - Número: $idcotizacion";
                    $estado = 0;
                    $sqlNotis = "INSERT INTO notifications (user_id, message, is_read) VALUES (?, ?, ?)";
                    $stmtNotis = $conexion->prepare($sqlNotis);
                    $stmtNotis->bind_param("isi", $idcliente, $mensaje, $estado);
                    $stmtNotis->execute();
                    $stmtNotis->close();
                }
    
                $conexion->commit();
                $stmt->close();
                $conexion->close();
                return true;
            } else {
                $conexion->rollback();
                $stmt->close();
                $conexion->close();
                return false;
            }
        } catch (Exception $e) {
            $conexion->rollback();
            echo "Error al actualizar la cotización: " . $e->getMessage();
            return false;
        }
    }
    
    public function obtenerClientePorId($idcliente) {
        try {
            $conexion = Conectar::conexion();
            
            $sql = "SELECT * FROM tbcliente WHERE idcliente = ?";
            
            $stmt = $conexion->prepare($sql);
            
            $stmt->bind_param("i", $idcliente);
            
            $stmt->execute();
            
            $resultado = $stmt->get_result();
            
            $cliente = $resultado->fetch_assoc();
            
            $stmt->close();
            $conexion->close();
            return $cliente;
        } catch (Exception $e) {
            echo "Error al obtener cliente por ID: " . $e->getMessage();
            return false;
        }
    }
    
    public function obtenerMaquinariaPorId($idmaquinaria) {
        try {
            $conexion = Conectar::conexion();
            
            $sql = "SELECT * FROM tbmaquinaria WHERE idmaquinaria = ?";
            
            $stmt = $conexion->prepare($sql);
            
            $stmt->bind_param("i", $idmaquinaria);
            
            $stmt->execute();
            
            $resultado = $stmt->get_result();
            
            $maquinaria = $resultado->fetch_assoc();
            
            $stmt->close();
            $conexion->close();
            return $maquinaria;
        } catch (Exception $e) {
            echo "Error al obtener maquinaria por ID: " . $e->getMessage();
            return false;
        }
    }
    
    public function obtenerLugarPorId($idlugar) {
        try {
            $conexion = Conectar::conexion();
            
            $sql = "SELECT * FROM tblugar WHERE idlugar = ?";
            
            $stmt = $conexion->prepare($sql);
            
            $stmt->bind_param("i", $idlugar);
            
            $stmt->execute();
            
            $resultado = $stmt->get_result();
            
            $lugar = $resultado->fetch_assoc();
            
            $stmt->close();
            $conexion->close();
            return $lugar;
        } catch (Exception $e) {
            echo "Error al obtener lugar por ID: " . $e->getMessage();
            return false;
        }
    }
    
    public function agregarCotizacion($idcliente = null) {
        try {
            $conexion = Conectar::conexion();
            
            $sql = "INSERT INTO tbcotizacion (idcliente) VALUES (?)";
            
            $stmt = $conexion->prepare($sql);
            
            $stmt->bind_param("i", $idcliente);
            
            $stmt->execute();
            
            $idcotizacion = $stmt->insert_id;
            
            $stmt->close();
            $conexion->close();
            return $idcotizacion;
        } catch (Exception $e) {
            echo "Error al agregar la cotización: " . $e->getMessage();
            return false;
        }
    }
    
    public function obtenerTodasMaquinarias() {
        try {
            $conexion = Conectar::conexion();
            
            $sql = "SELECT * FROM tbmaquinaria";
            
            $resultado = $conexion->query($sql);
            
            $maquinarias = [];
            while ($row = $resultado->fetch_assoc()) {
                $maquinarias[] = $row;
            }
            
            $conexion->close();
            return $maquinarias;
        } catch (Exception $e) {
            echo "Error al obtener las maquinarias: " . $e->getMessage();
            return false;
        }
    }
    
    public function obtenerTodosLugares() {
        try {
            $conexion = Conectar::conexion();
            
            $sql = "SELECT * FROM tblugar";
            
            $resultado = $conexion->query($sql);
            
            $lugares = [];
            while ($row = $resultado->fetch_assoc()) {
                $lugares[] = $row;
            }
            
            $conexion->close();
            return $lugares;
        } catch (Exception $e) {
            echo "Error al obtener los lugares: " . $e->getMessage();
            return false;
        }
    }

}
?>
