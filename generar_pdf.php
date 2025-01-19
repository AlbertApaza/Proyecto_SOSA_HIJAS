<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/DB/LIBS/LIB_PDF/fpdf.php';
require_once __DIR__ . '/DB/db.php';

$template_path = __DIR__ . '/templates';

if (isset($_SESSION['pdf_data'])) {
    $data = $_SESSION['pdf_data'];
    $idcliente = $data['idcliente'];
    $idcotizacion = $data['idcotizacion'];
    $correo_destinatario = isset($data['correo_destinatario']) ? $data['correo_destinatario'] : '';

    $query = "SELECT 
                c.idcotizacion, 
                cl.nombre AS cliente_nombre, 
                cl.apellido AS cliente_apellido, 
                cl.correo AS cliente_correo,
                cl.documento AS cliente_documento,
                cl.horaregistro AS cliente_registro,
                m.nombre AS maquinaria_nombre, 
                m.marca AS maquinaria_marca, 
                m.modelo AS maquinaria_modelo, 
                l.ciudad AS lugar_ciudad, 
                c.total, 
                c.tiempo 
            FROM 
                tbcotizacion c
                JOIN tbcliente cl ON c.idcliente = cl.idcliente
                JOIN tbmaquinaria m ON c.idmaquinaria = m.idmaquinaria
                JOIN tblugar l ON c.idlugar = l.idlugar
            WHERE 
                c.idcotizacion = ?";

    $conn = Conectar::conexion();

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $idcotizacion);
        $stmt->execute();
        $result = $stmt->get_result();
        $detalle = $result->fetch_assoc();
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
        exit();
    }

    // Generar PDF
    class PDF extends FPDF {
        private $template_path;

        public function __construct($template_path) {
            parent::__construct();
            $this->template_path = $template_path;
        }

        function Header() {
            // Logo
            $this->Image($this->template_path . '/../plantilla.png', 0, 0, 220);
            

        }
        
        function Body($detalle) {
            $this->SetFont('Arial', '', 12);
            $modelo_x = ($this->GetPageWidth() - 40) / 3;

            // Encabezado
            $modelo_y01= 37;
            $this->SetXY($modelo_x, $modelo_y01);
            $this->Cell(0, 20, $detalle['idcotizacion'], 0, 1, 'L');
            $modelo_yfecha= 42;
            $this->SetXY($modelo_x, $modelo_yfecha);
            $this->Cell(0, 20, $detalle['cliente_registro'], 0, 1, 'L');
           
            $modelo_y02 = 75;
            $this->SetXY($modelo_x, $modelo_y02);
            $this->Cell(0, 10, $detalle['cliente_nombre'] . ' ' . $detalle['cliente_apellido'], 0, 1, 'L');

            $modelo_y03 = 83;
            $this->SetXY($modelo_x, $modelo_y03);
            $this->Cell(0, 10, $detalle['cliente_documento'] , 0, 1, 'L');

            $modelo_y04 = 90;
            $this->SetXY($modelo_x, $modelo_y04);
            $this->Cell(0, 10, $detalle['cliente_correo'], 0, 1, 'L');
        
            // Información de la maquinaria
            $modelo_x = ($this->GetPageWidth() - 40) / 2;
            $modelo_y1= 121;
            $modelo_y2 = 125;
            $modelo_y3 = 129;

            $this->SetXY($modelo_x, $modelo_y1);
            $this->Cell(40, 10, '  ', 0, 0, 'L');

            $this->Cell(0, 10, $detalle['maquinaria_nombre'], 0, 1, 'L');
            $this->SetXY($modelo_x, $modelo_y2);
            $this->Cell(40, 10, 'Marca: ', 0, 0, 'L');
            $this->Cell(0, 10, $detalle['maquinaria_marca'], 0, 1, 'L');
            $this->SetXY($modelo_x, $modelo_y3);
            $this->Cell(40, 10, 'Modelo: ', 0, 0, 'L');
            $this->Cell(0, 10, $detalle['maquinaria_modelo'], 0, 1, 'L');
        

            // Tiempo
            $modelo_y4 = 137;
            $this->SetXY($modelo_x, $modelo_y4);
            $this->Cell(0, 10, $detalle['tiempo'], 0, 1, 'L');

            // Ubicación
            $modelo_y5 = 149;
            $this->SetXY($modelo_x, $modelo_y5);
            $this->Cell(0, 10, $detalle['lugar_ciudad'], 0, 1, 'L');
        
            // Totales
            $modelo_derechax = ($this->GetPageWidth() + 50) / 3;
            $modelo_sub= 186;
            $modelo_IGV= 193;
            $modelo_total= 204;
            $this->SetXY(168, $modelo_sub);
            $this->Cell(40, 10, ($detalle['total']-($detalle['total']* 0.18)), 0, 1, 'L');
            
            $this->SetXY(168, $modelo_IGV);
            $this->Cell(40, 10, ($detalle['total'] * 0.18), 0, 1, 'L');
            
            $this->SetXY(160, $modelo_total);
            $this->Cell(40, 10, $detalle['total'], 0, 1, 'L');
        

        }
    }

    $pdf = new PDF($template_path);
    $pdf->AddPage();
    $pdf->Body($detalle);

    // Guardar el PDF en el servidor
    $timestamp = date('Y-m-d_H-i-s');
    $pdf_file_path = __DIR__ . '/DB/PDFS/_idcot_' . $idcotizacion . '_' . $timestamp . '.pdf';
    $pdf->Output('F', $pdf_file_path);

    // Almacenar la ruta del archivo PDF y el correo del destinatario en la sesión
    $_SESSION['pdf_file_path'] = $pdf_file_path;
    $_SESSION['correo_cliente'] = $detalle['cliente_correo'];

    // Redirigir a email.php para enviar el correo
    header('Location: email.php');
    exit();
} else {
    require_once("seguridad.php"); 
    echo "No hay datos para generar el PDF.";
}
?>
