<?php
class clsContrato {
    public function listarContratoAdmin() {
        require_once("MODEL/Contrato.php");
        $contrato = new Contrato();
        $datos = $contrato->listarContrato();
        require_once("VIEW/CONTRATO/index.php");
    }

    public function agregarContratoAdmin($idreserva, $idcotizacion) {
        require_once("MODEL/Contrato.php");
        $contrato = new Contrato();
        $contrato->agregarContrato($idreserva, $idcotizacion);
    }

    public function editarContratoAdmin($idcontrato, $idreserva, $idcotizacion) {
        require_once("MODEL/Contrato.php");
        $contrato = new Contrato();
        $contrato->editarContrato($idcontrato, $idreserva, $idcotizacion);
    }

    public function eliminarContratoAdmin($idcontrato) {
        require_once("MODEL/Contrato.php");
        $contrato = new Contrato();
        $resultado = $contrato->eliminarContrato($idcontrato);

        if ($resultado) {
            header("Location: admin.php?action=listarContrato");
        } else {
            echo "Error al eliminar el contrato.";
        }
        exit();
    }

    public function buscarContratoAdmin($termino) {
        require_once("MODEL/Contrato.php");
        $contrato = new Contrato();
        $datos = $contrato->buscarContrato($termino);
        require_once("VIEW/CONTRATO/index.php");
    }

    public function mostrarFormularioEditar($idcontrato) {
        require_once("MODEL/Contrato.php");
        $contrato = new Contrato();
        $datos = $contrato->obtenerContratoPorId($idcontrato);
        require_once("VIEW/CONTRATO/editar.php");
    }

    public function generarContratoPDF($idcontrato) {
        $contrato = $this->modelContrato->obtenerContratoPorId($idcontrato);

        if (!$contrato) {
            die('Contrato no encontrado');
        }

        require_once 'fpdf/fpdf.php';
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Contrato");

        // Header
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Contrato de Alquiler", 0, 1, 'C');
        $pdf->Ln(10);

        // Client Information
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, "Informacion del Cliente", 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, "Nombre: " . utf8_decode($contrato['nombre'] . ' ' . $contrato['apellido']), 0, 1);
        $pdf->Cell(0, 10, "Correo: " . utf8_decode($contrato['correo']), 0, 1);
        $pdf->Cell(0, 10, "Telefono: " . utf8_decode($contrato['telefono']), 0, 1);
        $pdf->Ln(10);

        // Machine Information
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, "Informacion de la Maquinaria", 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, "Descripcion: " . utf8_decode($contrato['descripcion']), 0, 1);
        $pdf->Ln(10);

        // Reservation Information
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, "Informacion de la Reserva", 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, "Fecha de Inicio: " . $contrato['fechainicio'], 0, 1);
        $pdf->Cell(0, 10, "Fecha de Fin: " . $contrato['fechafin'], 0, 1);
        $pdf->Cell(0, 10, "Estado: " . $contrato['estado'], 0, 1);
        $pdf->Ln(10);

        // Quotation Information
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, "Informacion de la Cotizacion", 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, "Total: " . $contrato['total'], 0, 1);
        $pdf->Cell(0, 10, "Tiempo: " . $contrato['tiempo'] . " dias", 0, 1);
        $pdf->Ln(10);

        // Location Information
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, "Lugar de Servicio", 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, "Direccion: " . utf8_decode($contrato['direccion']), 0, 1);
        $pdf->Ln(10);

        $pdf->Output("contrato_$idcontrato.pdf", "I");
    }
}
?>
