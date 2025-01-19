<?php
require_once("MODEL/Empleado.php");

class clsEmpleado {
    
    public function listarEmpleadosAdmin() {
        $emp = new Empleado();
        $datos = $emp->listarEmpleados();
        require_once("VIEW/EMPLEADO/index.php");
    }

    public function agregarEmpleadoAdmin($idcargo, $nombre, $apellido, $dni) {
        $emp = new Empleado();
        $emp->agregarEmpleado($idcargo, $nombre, $apellido, $dni);
        $this->listarEmpleadosAdmin();
    }

    public function editarEmpleadoAdmin($idempleado, $idcargo, $nombre, $apellido, $dni) {
        $emp = new Empleado();
        $resultado = $emp->editarEmpleado($idempleado, $idcargo, $nombre, $apellido, $dni);

        if ($resultado) {
            $this->listarEmpleadosAdmin();
        } else {
            $this->listarEmpleadosAdmin();
        }
    }

    public function mostrarFormularioEditar($idempleado) {
        if (!isset($idempleado) || empty($idempleado)) {
            echo "Error: ID de empleado no especificado.";
            return;
        }

        $emp = new Empleado();
        $empleado = $emp->buscarEmpleadoPorId($idempleado);

        if (!$empleado) {
            echo "Error: No se encontró el empleado con el ID especificado.";
            return;
        }

        require_once("VIEW/EMPLEADO/editar.php");
    }

    public function eliminarEmpleadoAdmin($idempleado) {
        $emp = new Empleado();
        $resultado = $emp->eliminarEmpleado($idempleado);

        if ($resultado) {
            $this->listarEmpleadosAdmin();
        } else {
            $this->listarEmpleadosAdmin();
        }
    }
}
?>
