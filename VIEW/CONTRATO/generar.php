<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../DB/db.php';

require_once 'fpdf/fpdf.php';

if (isset($_GET['idreserva'])) {
    $idReserva = $_GET['idreserva'];

    $conexion = Conectar::conexion();

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $consulta = "SELECT r.idreserva, r.idcliente, r.idmaquinaria, r.idcotize, r.idempleado, r.fechareserva, r.fechainicio, r.fechafin, r.estado,
                        c.nombre AS nombre_cliente, c.apellido AS apellido_cliente, c.documento AS dni_cliente,
                        m.numserie AS numero_maquinaria, m.nombre AS tipo_maquinaria, m.costoh AS precio_maquinaria,
                        e.nombre AS nombre_empleado, e.apellido AS apellido_empleado,
                        q.tiempo, q.total
                 FROM tbreserva r
                 JOIN tbcliente c ON r.idcliente = c.idcliente
                 JOIN tbmaquinaria m ON r.idmaquinaria = m.idmaquinaria
                 JOIN tbempleado e ON r.idempleado = e.idempleado
                 JOIN tbcotizacion q ON r.idcotize = q.idcotizacion
                 WHERE r.idreserva = ?";

    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("i", $idReserva);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $datosReserva = $resultado->fetch_assoc();

        // Crear un nuevo documento PDF
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Contrato de Alquiler");
        $pdf->Image('../../sosalogo.png', 10, 10, 30);
        // Configurar el contenido del PDF
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'CONTRATO DE ALQUILER', 0, 1, 'C');
        $pdf->Ln(10);

        // Información del ARRENDADOR
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Nombre: ' . utf8_decode('SOSA E HIJAS S.A.C.                                                                      RUC: 2044921677'), 0, 1, 'L');
        $pdf->Ln(5);

        // Información del ARRENDATARIO y reserva
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'EL Sr./Sra. ' . utf8_decode($datosReserva['nombre_cliente'] . ' ' . $datosReserva['apellido_cliente']. ' ' .'con DNI: ' . $datosReserva['dni_cliente']), 0, 1, 'L');
        $pdf->Cell(0, 10, 'Para alquilar ' . utf8_decode($datosReserva['tipo_maquinaria']. ' ' .'con el numero de serie ' . $datosReserva['numero_maquinaria']. ' ' .'Costo S/ ' . number_format($datosReserva['precio_maquinaria'], 2) . ' por hora, incluye IGV si es'), 0, 1, 'L');
        $pdf->Cell(0, 10, 'cliente juridico'. ' ' .'Desde el ' . $datosReserva['fechainicio']. ' ' .'hasta el ' . $datosReserva['fechafin'], 0, 1, 'L');
        $pdf->Cell(0, 10, 'Tiempo de Uso es de ' . $datosReserva['tiempo']. ' ' . 'horas ,La suma por ese periodo de tiempo es de s/' . number_format($datosReserva['total']). ' soles', 0, 1, 'L');
        $pdf->Ln(10);

        // Condiciones del contrato
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'CONDICIONES DEL CONTRATO', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 10, utf8_decode("- El cliente se compromete a entregar la maquinaria en perfectas condiciones de funcionamiento.\n- El cliente utilizará la maquinaria exclusivamente para los fines acordados y responderá por los daños causados durante su uso.\n- El cliente debe informar de cualquier avería o problema con la maquinaria de forma inmediata al cliente.\n"), 0, 'L');
        $pdf->MultiCell(0, 10, utf8_decode("El pago deberá realizarse conforme a lo acordado entre las partes."), 0, 'L');
        $pdf->Ln(10);

        // Firma y Aceptación
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, '__________________________'. '                                  ' .'__________________________', 0, 1, 'L');
        $pdf->Cell(0, 10, utf8_decode($datosReserva['nombre_cliente'] . ' ' . $datosReserva['apellido_cliente'] . '                                                                                             ' .$datosReserva['nombre_empleado'] . ' ' . $datosReserva['apellido_empleado']), 0, 1, 'L');
        $pdf->Cell(0, 10, 'Firma del Cliente'. '                                      ' .'Representante de SOSA E HIJAS S.A.C.', 0, 1, 'L');
        $pdf->Ln(20);

        ob_clean();
        $pdf->Output('D', 'Contrato_Alquiler_Maquinaria.pdf');
    } else {
        die("Reserva no encontrada");
    }

    $conexion->close();
} else {
    die("ID de reserva no proporcionado");
}
?>
