<?php
class clsMantenimiento {
    public function listarMantenimientoAdmin() {
        require_once("MODEL/Mantenimiento.php");
        $mant = new Mantenimiento();
        $datos = $mant->listarMantenimiento();
        require_once("VIEW/MANTENIMIENTO/index.php");
    }

    public function agregarMantenimientoAdmin($idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo) {
        require_once("MODEL/Mantenimiento.php");
        $mant = new Mantenimiento();
        $mant->agregarMantenimiento($idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo);
    }
    public function mostrarFormularioAgregar() {
        require_once("MODEL/Mantenimiento.php");
        $mant = new Mantenimiento();
        $empleados = $mant->obtenerEmpleados();
        $maquinarias = $mant->obtenerMaquinarias();
        require_once("VIEW/MANTENIMIENTO/agregar.php");
    }

    public function mostrarFormularioEditar($idmantenimiento) {
        require_once("MODEL/Mantenimiento.php");
        $mant = new Mantenimiento();
        $datos = $mant->obtenerMantenimientoPorId($idmantenimiento);
    
        $empleados = $mant->obtenerEmpleados();
        $maquinarias = $mant->obtenerMaquinarias();
    
        require_once("VIEW/MANTENIMIENTO/editar.php");
    }
    public function editarMantenimientoAdmin($idmantenimiento, $idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo) {
        require_once("MODEL/Mantenimiento.php");
        $mant = new Mantenimiento();
        $mant->editarMantenimiento($idmantenimiento, $idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo);
    }
    

    public function eliminarMantenimientoAdmin($idmantenimiento) {
        require_once("MODEL/Mantenimiento.php");
        $mant = new Mantenimiento();
        $resultado = $mant->eliminarMantenimiento($idmantenimiento);

        if ($resultado) {
            header("Location: admin.php?action=listarMantenimiento");
        } else {
            echo "Error al eliminar el mantenimiento.";
        }
        exit();
    }

    public function buscarMantenimientoAdmin($termino) {
        require_once("MODEL/Mantenimiento.php");
        $mant = new Mantenimiento();
        $datos = $mant->buscarMantenimiento($termino);
        require_once("VIEW/MANTENIMIENTO/index.php");
    }

}
?>
