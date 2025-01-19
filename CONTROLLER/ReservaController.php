<?php
class clsReserva {
    public function listarReservaAdmin() {
        require_once("MODEL/Reserva.php");
        $reserva = new Reserva();
        $reservas = $reserva->listarReserva();
    
        require_once("VIEW/RESERVA/index.php");
    }
    

    public function mostrarFormularioAgregar() {
        require_once("MODEL/Reserva.php");
        $reserva = new Reserva();

        $clientes = $reserva->obtenerClientes();
        $maquinarias = $reserva->obtenerMaquinarias();
        $empleados = $reserva->obtenerEmpleados();

        $idcliente = isset($_POST['idcliente']) ? $_POST['idcliente'] : null;
        $idcotize = null;

        if ($idcliente) {
            $idcotize = $reserva->obtenerCotizacionPorCliente($idcliente);
        }

        require_once("VIEW/RESERVA/agregar.php");
    }

    public function agregarReservaAdmin($idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado) {
        require_once("MODEL/Reserva.php");
        $reserva = new Reserva();
        $reserva->agregarReserva($idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado);
    }
    public function mostrarFormularioEditar($idreserva) {
        require_once("MODEL/Reserva.php");
        $reservaModel = new Reserva();
    
        $datos = $reservaModel->obtenerReservaPorId($idreserva);
    
        $clientes = $reservaModel->obtenerClientes();
        $idcliente = $datos['idcliente'];
    
        $maquinarias = $reservaModel->obtenerMaquinarias();
        $empleados = $reservaModel->obtenerEmpleados();
    
        $idcotize = null;
        if ($idcliente) {
            $idcotize = $reservaModel->obtenerCotizacionPorCliente($idcliente);
        }
    
        require_once("VIEW/RESERVA/editar.php");
    }
    
    public function editarReservaAdmin($idreserva, $idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado) {
        require_once("MODEL/Reserva.php");
        $reserva = new Reserva();
        $reserva->editarReserva($idreserva, $idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado);
    }

    public function eliminarReservaAdmin($idreserva) {
        require_once("MODEL/Reserva.php");
        $reserva = new Reserva();
        $resultado = $reserva->eliminarReserva($idreserva);
    }

    public function buscarReservaAdmin($termino) {
        require_once("MODEL/Reserva.php");
        $reserva = new Reserva();
        $datos = $reserva->buscarReserva($termino);
        require_once("VIEW/RESERVA/buscar.php");
    }
    
}

?>
