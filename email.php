<?php
session_start();
require_once __DIR__ . '/DB/LIBS/LIB_PHPMAILER/PHPMailerAutoload.php';
require_once __DIR__ . '/DB/LIBS/LIB_PHPMAILER/class.phpmailer.php';
require_once __DIR__ . '/DB/LIBS/LIB_PHPMAILER/class.smtp.php';

$correo_emisor = 'sosahijas@gmail.com';
$contrasena = 'kdpy nbss bgfu kdgc';

$pdf_file_path = isset($_SESSION['pdf_file_path']) ? $_SESSION['pdf_file_path'] : '';
$correo_cliente = isset($_SESSION['correo_cliente']) ? $_SESSION['correo_cliente'] : '';

if (!empty($pdf_file_path) && file_exists($pdf_file_path)) {
    $mail = new PHPMailer();

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $correo_emisor;
        $mail->Password = $contrasena;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($correo_emisor, 'Empresa Sosa e HIJAS');
        $mail->addAddress($correo_cliente); 

        $mail->Subject = 'Pedido de Cotizaci�n v�a WEB';

        // Obtener la fecha actual
        $fecha_actual = date('d/m/Y');

        $mail->isHTML(true);
        $mail->Body = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                }
                .container {
                    padding: 20px;
                    background-color: #f9f9f9;
                    border: 1px solid #ddd;
                    border-radius: 10px;
                    max-width: 600px;
                    margin: 0 auto;
                }
                .header {
                    text-align: center;
                    padding-bottom: 20px;
                }
                .header h1 {
                    color: #333;
                }
                .content {
                    font-size: 14px;
                }
                .footer {
                    font-size: 12px;
                    color: #888;
                    text-align: center;
                    padding-top: 20px;
                    border-top: 1px solid #ddd;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Empresa Sosa e HIJAS</h1>
                </div>
                <div class='content'>
                    <p>Estimado cliente,</p>
                    <p>Por este medio le remitimos la cotizaci�n pedida el d�a <strong>$fecha_actual</strong>.</p>
                    <p>Agradecemos su preferencia y quedamos a su disposici�n para cualquier consulta adicional.</p>
                    <p>Atentamente,<br>Empresa Sosa e HIJAS</p>
                </div>
                <div class='footer'>
                    <p>------------------------</p>
                    <p>Este mensaje y sus archivos adjuntos son confidenciales y est�n dirigidos exclusivamente al destinatario de los mismos. Si usted ha recibido este correo por error, por favor, notif�quenos respondiendo a este mensaje y elimine el mismo inmediatamente.</p>
                    <p>�Gracias y que tenga un d�a maravilloso! UwU</p>
                </div>
            </div>
        </body>
        </html>";

        // Adjuntar el archivo PDF
        $mail->addAttachment($pdf_file_path);

        // Enviar el correo
        if ($mail->send()) {
            echo 'Correo enviado correctamente';
        } else {
            echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
    }

    unset($_SESSION['pdf_file_path']);
    unset($_SESSION['correo_cliente']);
} else {
    require_once("seguridad.php"); 
    echo 'No se encontr� el archivo PDF.';
}
?>
